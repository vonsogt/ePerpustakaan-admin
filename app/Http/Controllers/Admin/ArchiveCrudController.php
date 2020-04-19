<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ArchiveRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class ArchiveCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class ArchiveCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Archive');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/archive');
        $this->crud->setEntityNameStrings('peminjaman', 'peminjaman');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns([
            [
                'name' => "client_id",
                'label' => "Pengguna",
                'type' => "model_function",
                'function_name' => 'getClientWithLink',
                'limit' => 150,
            ],
            [
                'name' => "book_id",
                'label' => "Judul Buku",
                'type' => "model_function",
                'function_name' => 'getBookWithLink',
                'limit' => 150,
            ],
            [
                'name'        => 'event',
                'label'       => 'Status',
                'type'        => 'radio',
                'options'     => [
                    0 => "Pending",
                    1 => "Berlangsung",
                    2 => "Selesai",
                ],
            ],
            [
                'name' => "returned_at",
                'label' => "Waktu Pengembalian",
                'type' => "datetime",
                // 'format' => 'l j F Y H:i:s',
            ],
        ]);
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(ArchiveRequest::class);

        $this->crud->addFields([
            [
                'name'  => 'book_id',
                'label' => 'Buku',
                'type'  => 'select2_from_ajax',
                'entity' => 'book',
                'attribute' => "title",
                'data_source' => url("api/book"),
                'placeholder' => "Pilih buku",
                'minimum_input_length' => 2,
            ],
            [
                'name'  => 'client_id',
                'label' => 'Pengguna',
                'type'  => 'select2_from_ajax',
                'entity' => 'client',
                'attribute' => "first_name",
                'data_source' => url("api/client"),
                'placeholder' => "Pilih pengguna",
                'minimum_input_length' => 2,
            ],
            [
                'name'        => 'event',
                'label'       => 'Status',
                'type'        => 'radio',
                'options'     => [
                    0 => "Pending",
                    1 => "Berlangsung",
                    2 => "Selesai",
                ],
                'inline'      => true,
            ],
            [
                'name' => 'returned_at',
                'label' => 'Waktu Pengembalian',
                'type' => 'datetime_picker',
                // optional:
                'datetime_picker_options' => [
                    'format' => 'DD/MM/YYYY HH:mm',
                    'language' => 'id'
                ],
                'allows_null' => true,
            ],
            [
                'name' => 'notes',
                'label' => 'Catatan',
                'type' => 'textarea'
            ],
        ]);
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
