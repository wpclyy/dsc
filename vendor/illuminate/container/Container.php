<?php
//zend by QQ:2172298892  瑾梦网络  禁止倒卖 一经发现停止任何服务
namespace Illuminate\Container;

class Container implements \ArrayAccess, \Illuminate\Contracts\Container\Container
{
	/**
     * The current globally available container (if any).
     *
     * @var static
     */
	static protected $instance;
	/**
     * An array of the types that have been resolved.
     *
     * @var array
     */
	protected $resolved = array();
	/**
     * The container's bindings.
     *
     * @var array
     */
	protected $bindings = array();
	/**
     * The container's method bindings.
     *
     * @var array
     */
	protected $methodBindings = array();
	/**
     * The container's shared instances.
     *
     * @var array
     */
	protected $instances = array();
	/**
     * The registered type aliases.
     *
     * @var array
     */
	protected $aliases = array();
	/**
     * The registered aliases keyed by the abstract name.
     *
     * @var array
     */
	protected $abstractAliases = array();
	/**
     * The extension closures for services.
     *
     * @var array
     */
	protected $extenders = array();
	/**
     * All of the registered tags.
     *
     * @var array
     */
	protected $tags = array();
	/**
     * The stack of concretions currently being built.
     *
     * @var array
     */
	protected $buildStack = array();
	/**
     * The parameter override stack.
     *
     * @var array
     */
	protected $with = array();
	/**
     * The contextual binding map.
     *
     * @var array
     */
	public $contextual = array();
	/**
     * All of the registered rebound callbacks.
     *
     * @var array
     */
	protected $reboundCallbacks = array();
	/**
     * All of the global resolving callbacks.
     *
     * @var array
     */
	protected $globalResolvingCallbacks = array();
	/**
     * All of the global after resolving callbacks.
     *
     * @var array
     */
	protected $globalAfterResolvingCallbacks = array();
	/**
     * All of the resolving callbacks by class type.
     *
     * @var array
     */
	protected $resolvingCallbacks = array();
	/**
     * All of the after resolving callbacks by class type.
     *
     * @var array
     */
	protected $afterResolvingCallbacks = array();

	public function when($concrete)
	{
		return new ContextualBindingBuilder($this, $this->getAlias($concrete));
	}

	public function bound($abstract)
	{
		return isset($this->bindings[$abstract]) || isset($this->instances[$abstract]) || $this->isAlias($abstract);
	}

	public function resolved($abstract)
	{
		if ($this->isAlias($abstract)) {
			$abstract = $this->getAlias($abstract);
		}

		return isset($this->resolved[$abstract]) || isset($this->instances[$abstract]);
	}

	public function isShared($abstract)
	{
		return isset($this->instances[$abstract]) || (isset($this->bindings[$abstract]['shared']) && ($this->bindings[$abstract]['shared'] === true));
	}

	public function isAlias($name)
	{
		return isset($this->aliases[$name]);
	}

	public function bind($abstract, $concrete = NULL, $shared = false)
	{
		$this->dropStaleInstances($abstract);

		if (is_null($concrete)) {
			$concrete = $abstract;
		}

		if (!$concrete instanceof \Closure) {
			$concrete = $this->getClosure($abstract, $concrete);
		}

		$this->bindings[$abstract] = compact('concrete', 'shared');

		if ($this->resolved($abstract)) {
			$this->rebound($abstract);
		}
	}

	protected function getClosure($abstract, $concrete)
	{
		return function($container, $parameters = array()) use($abstract, $concrete) {
			if ($abstract == $concrete) {
				return $container->build($concrete);
			}

			return $container->makeWith($concrete, $parameters);
		};
	}

	public function hasMethodBinding($method)
	{
		return isset($this->methodBindings[$method]);
	}

	public function bindMethod($method, $callback)
	{
		$this->methodBindings[$method] = $callback;
	}

	public function callMethodBinding($method, $instance)
	{
		return call_user_func($this->methodBindings[$method], $instance, $this);
	}

	public function addContextualBinding($concrete, $abstract, $implementation)
	{
		$this->contextual[$concrete][$this->getAlias($abstract)] = $implementation;
	}

	public function bindIf($abstract, $concrete = NULL, $shared = false)
	{
		if (!$this->bound($abstract)) {
			$this->bind($abstract, $concrete, $shared);
		}
	}

	public function singleton($abstract, $concrete = NULL)
	{
		$this->bind($abstract, $concrete, true);
	}

	public function extend($abstract, \Closure $closure)
	{
		$abstract = $this->getAlias($abstract);

		if (isset($this->instances[$abstract])) {
			$this->instances[$abstract] = $closure($this->instances[$abstract], $this);
			$this->rebound($abstract);
		}
		else {
			$this->extenders[$abstract][] = $closure;

			if ($this->resolved($abstract)) {
				$this->rebound($abstract);
			}
		}
	}

	public function instance($abstract, $instance)
	{
		$this->removeAbstractAlias($abstract);
		$isBound = $this->bound($abstract);
		unset($this->aliases[$abstract]);
		$this->instances[$abstract] = $instance;

		if ($isBound) {
			$this->rebound($abstract);
		}
	}

	protected function removeAbstractAlias($searched)
	{
		if (!isset($this->aliases[$searched])) {
			return NULL;
		}

		foreach ($this->abstractAliases as $abstract => $aliases) {
			foreach ($aliases as $index => $alias) {
				if ($alias == $searched) {
					unset($this->abstractAliases[$abstract][$index]);
				}
			}
		}
	}

	public function tag($abstracts, $tags)
	{
		$tags = (is_array($tags) ? $tags : array_slice(func_get_args(), 1));

		foreach ($tags as $tag) {
			if (!isset($this->tags[$tag])) {
				$this->tags[$tag] = array();
			}

			foreach ((array) $abstracts as $abstract) {
				$this->tags[$tag][] = $abstract;
			}
		}
	}

	public function tagged($tag)
	{
		$results = array();

		if (isset($this->tags[$tag])) {
			foreach ($this->tags[$tag] as $abstract) {
				$results[] = $this->make($abstract);
			}
		}

		return $results;
	}

	public function alias($abstract, $alias)
	{
		$this->aliases[$alias] = $abstract;
		$this->abstractAliases[$abstract][] = $alias;
	}

	public function rebinding($abstract, \Closure $callback)
	{
		$this->reboundCallbacks[$abstract = $this->getAlias($abstract)][] = $callback;

		if ($this->bound($abstract)) {
			return $this->make($abstract);
		}
	}

	public function refresh($abstract, $target, $method)
	{
		return $this->rebinding($abstract, function($app, $instance) use($target, $method) {
			$target->$method($instance);
		});
	}

	protected function rebound($abstract)
	{
		$instance = $this->make($abstract);

		foreach ($this->getReboundCallbacks($abstract) as $callback) {
			call_user_func($callback, $this, $instance);
		}
	}

	protected function getReboundCallbacks($abstract)
	{
		if (isset($this->reboundCallbacks[$abstract])) {
			return $this->reboundCallbacks[$abstract];
		}

		return array();
	}

	public function wrap(\Closure $callback, array $parameters = array())
	{
		return function() use($callback, $parameters) {
			return $this->call($callback, $parameters);
		};
	}

	public function call($callback, array $parameters = array(), $defaultMethod = NULL)
	{
		return BoundMethod::call($this, $callback, $parameters, $defaultMethod);
	}

	public function factory($abstract)
	{
		return function() use($abstract) {
			return $this->make($abstract);
		};
	}

	public function makeWith($abstract, array $parameters)
	{
		return $this->resolve($abstract, $parameters);
	}

	public function make($abstract)
	{
		return $this->resolve($abstract);
	}

	protected function resolve($abstract, $parameters = array())
	{
		$abstract = $this->getAlias($abstract);
		$needsContextualBuild = !empty($parameters) || !is_null($this->getContextualConcrete($abstract));
		if (isset($this->instances[$abstract]) && !$needsContextualBuild) {
			return $this->instances[$abstract];
		}

		$this->with[] = $parameters;
		$concrete = $this->getConcrete($abstract);

		if ($this->isBuildable($concrete, $abstract)) {
			$object = $this->build($concrete);
		}
		else {
			$object = $this->make($concrete);
		}

		foreach ($this->getExtenders($abstract) as $extender) {
			$object = $extender($object, $this);
		}

		if ($this->isShared($abstract) && !$needsContextualBuild) {
			$this->instances[$abstract] = $object;
		}

		$this->fireResolvingCallbacks($abstract, $object);
		$this->resolved[$abstract] = true;
		array_pop($this->with);
		return $object;
	}

	protected function getConcrete($abstract)
	{
		if (!is_null($concrete = $this->getContextualConcrete($abstract))) {
			return $concrete;
		}

		if (isset($this->bindings[$abstract])) {
			return $this->bindings[$abstract]['concrete'];
		}

		return $abstract;
	}

	protected function getContextualConcrete($abstract)
	{
		if (!is_null($binding = $this->findInContextualBindings($abstract))) {
			return $binding;
		}

		if (empty($this->abstractAliases[$abstract])) {
			return NULL;
		}

		foreach ($this->abstractAliases[$abstract] as $alias) {
			if (!is_null($binding = $this->findInContextualBindings($alias))) {
				return $binding;
			}
		}
	}

	protected function findInContextualBindings($abstract)
	{
		if (isset($this->contextual[end($this->buildStack)][$abstract])) {
			return $this->contextual[end($this->buildStack)][$abstract];
		}
	}

	protected function isBuildable($concrete, $abstract)
	{
		return ($concrete === $abstract) || $concrete instanceof \Closure;
	}

	public function build($concrete)
	{
		if ($concrete instanceof \Closure) {
			return $concrete($this, $this->getLastParameterOverride());
		}

		$reflector = new \ReflectionClass($concrete);

		if (!$reflector->isInstantiable()) {
			return $this->notInstantiable($concrete);
		}

		$this->buildStack[] = $concrete;
		$constructor = $reflector->getConstructor();

		if (is_null($constructor)) {
			array_pop($this->buildStack);
			return new $concrete();
		}

		$dependencies = $constructor->getParameters();
		$instances = $this->resolveDependencies($dependencies);
		array_pop($this->buildStack);
		return $reflector->newInstanceArgs($instances);
	}

	protected function resolveDependencies(array $dependencies)
	{
		$results = array();

		foreach ($dependencies as $dependency) {
			if ($this->hasParameterOverride($dependency)) {
				$results[] = $this->getParameterOverride($dependency);
				continue;
			}

			$results[] = is_null($class = $dependency->getClass()) ? $this->resolvePrimitive($dependency) : $this->resolveClass($dependency);
		}

		return $results;
	}

	protected function hasParameterOverride($dependency)
	{
		return array_key_exists($dependency->name, $this->getLastParameterOverride());
	}

	protected function getParameterOverride($dependency)
	{
		return $this->getLastParameterOverride()[$dependency->name];
	}

	protected function getLastParameterOverride()
	{
		return count($this->with) ? end($this->with) : array();
	}

	protected function resolvePrimitive(\ReflectionParameter $parameter)
	{
		if (!is_null($concrete = $this->getContextualConcrete('$' . $parameter->name))) {
			return $concrete instanceof \Closure ? $concrete($this) : $concrete;
		}

		if ($parameter->isDefaultValueAvailable()) {
			return $parameter->getDefaultValue();
		}

		$this->unresolvablePrimitive($parameter);
	}

	protected function resolveClass(\ReflectionParameter $parameter)
	{
		try {
/* [31m * TODO SEPARATE[0m */
			return $this->make($parameter->getClass()->name);
		}
		catch (\Illuminate\Contracts\Container\BindingResolutionException $e) {
			if ($parameter->isOptional()) {
				return $parameter->getDefaultValue();
			}

			throw $e;
		}
	}

	protected function notInstantiable($concrete)
	{
		if (!empty($this->buildStack)) {
			$previous = implode(', ', $this->buildStack);
			$message = 'Target [' . $concrete . '] is not instantiable while building [' . $previous . '].';
		}
		else {
			$message = 'Target [' . $concrete . '] is not instantiable.';
		}

		throw new \Illuminate\Contracts\Container\BindingResolutionException($message);
	}

	protected function unresolvablePrimitive(\ReflectionParameter $parameter)
	{
		$message = 'Unresolvable dependency resolving [' . $parameter . '] in class ' . $parameter->getDeclaringClass()->getName();
		throw new \Illuminate\Contracts\Container\BindingResolutionException($message);
	}

	public function resolving($abstract, \Closure $callback = NULL)
	{
		if (is_string($abstract)) {
			$abstract = $this->getAlias($abstract);
		}

		if (is_null($callback) && $abstract instanceof \Closure) {
			$this->globalResolvingCallbacks[] = $abstract;
		}
		else {
			$this->resolvingCallbacks[$abstract][] = $callback;
		}
	}

	public function afterResolving($abstract, \Closure $callback = NULL)
	{
		if (is_string($abstract)) {
			$abstract = $this->getAlias($abstract);
		}

		if ($abstract instanceof \Closure && is_null($callback)) {
			$this->globalAfterResolvingCallbacks[] = $abstract;
		}
		else {
			$this->afterResolvingCallbacks[$abstract][] = $callback;
		}
	}

	protected function fireResolvingCallbacks($abstract, $object)
	{
		$this->fireCallbackArray($object, $this->globalResolvingCallbacks);
		$this->fireCallbackArray($object, $this->getCallbacksForType($abstract, $object, $this->resolvingCallbacks));
		$this->fireAfterResolvingCallbacks($abstract, $object);
	}

	protected function fireAfterResolvingCallbacks($abstract, $object)
	{
		$this->fireCallbackArray($object, $this->globalAfterResolvingCallbacks);
		$this->fireCallbackArray($object, $this->getCallbacksForType($abstract, $object, $this->afterResolvingCallbacks));
	}

	protected function getCallbacksForType($abstract, $object, array $callbacksPerType)
	{
		$results = array();

		foreach ($callbacksPerType as $type => $callbacks) {
			if (($type === $abstract) || $object instanceof $type) {
				$results = array_merge($results, $callbacks);
			}
		}

		return $results;
	}

	protected function fireCallbackArray($object, array $callbacks)
	{
		foreach ($callbacks as $callback) {
			$callback($object, $this);
		}
	}

	public function getBindings()
	{
		return $this->bindings;
	}

	public function getAlias($abstract)
	{
		if (!isset($this->aliases[$abstract])) {
			return $abstract;
		}

		if ($this->aliases[$abstract] === $abstract) {
			throw new \LogicException('[' . $abstract . '] is aliased to itself.');
		}

		return $this->getAlias($this->aliases[$abstract]);
	}

	protected function getExtenders($abstract)
	{
		$abstract = $this->getAlias($abstract);

		if (isset($this->extenders[$abstract])) {
			return $this->extenders[$abstract];
		}

		return array();
	}

	public function forgetExtenders($abstract)
	{
		unset($this->extenders[$this->getAlias($abstract)]);
	}

	protected function dropStaleInstances($abstract)
	{
		unset($this->instances[$abstract]);
		unset($this->aliases[$abstract]);
	}

	public function forgetInstance($abstract)
	{
		unset($this->instances[$abstract]);
	}

	public function forgetInstances()
	{
		$this->instances = array();
	}

	public function flush()
	{
		$this->aliases = array();
		$this->resolved = array();
		$this->bindings = array();
		$this->instances = array();
		$this->abstractAliases = array();
	}

	static public function getInstance()
	{
		if (is_null(static::$instance)) {
			static::$instance = new static();
		}

		return static::$instance;
	}

	static public function setInstance(\Illuminate\Contracts\Container\Container $container = NULL)
	{
		return static::$instance = $container;
	}

	public function offsetExists($key)
	{
		return $this->bound($key);
	}

	public function offsetGet($key)
	{
		return $this->make($key);
	}

	public function offsetSet($key, $value)
	{
		$this->bind($key, $value instanceof \Closure ? $value : function() use($value) {
			return $value;
		});
	}

	public function offsetUnset($key)
	{
		unset($this->bindings[$key]);
		unset($this->instances[$key]);
		unset($this->resolved[$key]);
	}

	public function __get($key)
	{
		return $this[$key];
	}

	public function __set($key, $value)
	{
		$this[$key] = $value;
	}
}

?>
