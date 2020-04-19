<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ClientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClientCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Client');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/client');
        $this->crud->setEntityNameStrings('pengguna', 'pengguna');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns(array(
            [
                'name'  => 'full_name',
                'label' => 'Nama Lengkap',
                'type'  => 'model_function',
                'function_name' => 'getFullName'
            ],
            [
                'name'  => 'identity',
                'label' => 'Identitas',
                'type'  => 'text',
            ],
            [
                'name'  => 'email',
                'label' => 'Email',
                'type'  => 'email',
            ],
            [
                'name'  => 'phone',
                'label' => 'Nomor HP',
                'type'  => 'phone',
            ]

        ));
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ClientRequest::class);

        $this->crud->addFields(array(
            [
                'name'  => 'first_name',
                'label' => 'Nama Depan',
                'type'  => 'text'
            ],
            [
                'name'  => 'last_name',
                'label' => 'Nama Belakang',
                'type'  => 'text'
            ],
            [
                'name'  => 'identity',
                'label' => 'Identitas',
                'type'  => 'text'
            ],
            [
                'name'  => 'email',
                'label' => 'Email',
                'type'  => 'email'
            ],
            [
                'name'  => 'phone',
                'label' => 'Nomor Hp',
                'type'  => 'text'
            ]
        ));
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
