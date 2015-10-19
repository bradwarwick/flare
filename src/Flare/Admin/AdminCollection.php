<?php

namespace LaravelFlare\Flare\Admin;

use Illuminate\Support\Collection;
use LaravelFlare\Flare\Admin\Admin;
use LaravelFlare\Flare\Permissions\Permissions;

class AdminCollection extends Collection
{
    /**
     * Base Class.
     *
     * The Base Class for Model Admin's
     */
    const BASE_CLASS = 'LaravelFlare\Flare\Admin\Admin';

    /**
     * Admin Config Key.
     *
     * Key which defined where in the Flare Admin Config to
     * load the Admin classes from.
     *
     * @var string
     */
    const ADMIN_KEY = 'admin';

    /**
     * __construct.
     */
    public function __construct()
    {
        parent::__construct();

        $this->items = $this->getAdminClasses();
    }

    /**
     * Gets Admin classes based on the current users permissions
     * which have been set. If a Admin class has not had the
     * Permissions provided, it will be displayed by default.
     * 
     * @return 
     */
    public function getAdminClasses()
    {
        $classCollection = [];

        if (!defined('static::ADMIN_KEY')) {
            return $classCollection;
        }

        foreach (\Flare::config(static::ADMIN_KEY) as $class) {
            if (!$this->usableClass($class)) {
                continue;
            }
            $classCollection[] = new $class();
        }

        return $classCollection;
    }

    /**
     * Returns an instance of the Admin.
     * 
     * @return Admin
     */
    public static function getAdminInstance()
    {
        if (!$requested = Admin::getRequested()) {
            return;
        }

        return new $requested();
    }

    /**
     * Register Admin Routes.
     *
     * Loops through all of the Admin classes in the collection
     * and registers their Admin Routes
     */
    public function registerRoutes()
    {
        foreach ($this->items as $class) {
            (new $class())->registerRoutes();
        }
    }

    /**
     * Determines if a class is usable by the currently
     * defined user and their permission set.
     * 
     * @param string $class
     * 
     * @return bool
     */
    private function usableClass($class)
    {
        if ($class == static::BASE_CLASS) {
            return false;
        }

        if (!$this->checkAdminPermissions($class)) {
            return false;
        }

        return true;
    }

    /**
     * Checks whether a AdminPermissions are set if they are
     * it will check validity for the current user otherwise
     * it will return true, since all users have access
     * to this Admin Section.
     * 
     * @param string $class
     * 
     * @return bool
     */
    private function checkAdminPermissions($class)
    {
        $reflection = new \ReflectionClass(new $class());

        if (!$reflection->implementsInterface(\LaravelFlare\Flare\Contracts\PermissionsInterface::class)) {
            return true;
        }

        return $this->checkUserHasAdminPermissions($class);
    }

    /**
     * Checks if the current user has access to a given 
     * Admin class and returns a boolean.
     *
     * @param string $class
     * 
     * @return bool
     */
    private function checkUserHasAdminPermissions($class)
    {
        return Permissions::check($class);
    }
}
