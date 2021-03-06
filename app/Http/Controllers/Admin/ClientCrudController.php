<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ClientRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


/**
 * Class ClientCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ClientCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
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
            ],
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
            ],
            [
                'name' => 'password',
                'label' => 'Kata Sandi',
                'type' => 'password',
                'hint' => 'Kosongkan jika tidak ingin mengganti kata sandi.',
            ],
        ));
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        CRUD::column('first_name')
            ->type('text')
            ->label('Nama Depan');
        CRUD::column('last_name')
            ->type('text')
            ->label('Nama Belakang');
        CRUD::column('identity')
            ->type('text')
            ->label('Identitas');
        CRUD::column('email')
            ->type('email')
            ->label('Email');
        CRUD::column('phone')
            ->type('phone')
            ->label('Nomor HP');
    }

    public function store()
    {
        $request = request();
        $request = $this->crud->validateRequest();

        // Encrypt password if specified.
        if ($request->input('password')) {
            $this->crud->setRequest($request->request->add([
                'password' => Hash::make($request->input('password'))
            ]));
            // $request->request->set('password', Hash::make($request->input('password')));
        } else {
            $this->crud->setRequest($request->request->remove('password'));
            // $request->request->remove('password');
        }

        return $this->traitStore();
    }
}
