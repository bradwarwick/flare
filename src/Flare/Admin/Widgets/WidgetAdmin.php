<?php

namespace LaravelFlare\Flare\Admin\Widgets;

use LaravelFlare\Flare\Admin\Admin;

abstract class WidgetAdmin extends Admin
{
    /**
     * The Module Admin Default View
     *
     * @var string
     */
    protected static $view = 'admin.widgets.widget';

    /**
     * Default View Data
     *
     * @var array
     */
    protected $viewData = [];

    /**
     * Class Prefix used for matching and removing term
     * from user provided Admin sections.
     *
     * @var string
     */
    const CLASS_PREFIX = 'Widget';

    /**
     * Render the Widget
     * 
     * @return \Illuminate\Http\Response
     */
    public function render()
    {
        return view($this->getView(), []); //$this->getViewData()
    }

    /**
     * Returns the Widget Admin View
     *
     * @return string
     */
    public function getView()
    {
        if (view()->exists(static::$view)) {
            return $this->view;
        }

        if (view()->exists('admin.widgets.'.static::SafeTitle().'.widget')) {
            return 'admin.'.static::SafeTitle().'.index';
        }

        if (view()->exists('admin.widgets.'.static::SafeTitle())) {
            return 'admin.'.static::SafeTitle();
        }

        if (view()->exists('admin.'.static::SafeTitle())) {
            return 'admin.'.static::SafeTitle();
        }

        if (view()->exists('flare::'.self::$view)) {
            return 'flare::'.self::$view;
        }

        return parent::getView();
    }

    /**
     * Returns an Array of View Data that is constructed
     * using the current View Data and any inherited View Data
     * 
     * @return array
     */
    public function getViewData()
    {
        if (is_callable('parent::getViewData')) {
            $viewData = parent::getViewData();
        }

        return array_merge($this->viewData, $viewData);
    }

    /**
     * Widget SafeTitle
     *
     * @return string
     */
    public static function SafeTitle()
    {
        return str_replace(' ', '', strtolower(str_replace(static::CLASS_PREFIX, '',  static::Title())));
    }
}
