<?php

namespace LaravelFlare\Flare\Http\Requests;

use Route;
use LaravelFlare\Flare\Admin\AdminManager;

class ModelEditRequest extends AdminRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $modelManager = app(AdminManager::class)->getAdminInstance();
        $modelManager->find(\Route::current()->getParameter('one'));

        return $modelManager->getUpdateRules();
    }
}
