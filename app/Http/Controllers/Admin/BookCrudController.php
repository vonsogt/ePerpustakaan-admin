<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BookRequest;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class BookCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class BookCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    public function setup()
    {
        $this->crud->setModel('App\Models\Book');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/book');
        $this->crud->setEntityNameStrings('buku', 'buku');
    }

    protected function setupListOperation()
    {
        $this->crud->addColumns(array(
            [
                'name'  => 'title',
                'label' => 'Judul',
                'type'  => 'text',
                'limit' => 50
            ],
            [
                'name'  => 'author',
                'label' => 'Penulis',
                'type'  => 'text'
            ],
            [
                'name'  => 'editor',
                'label' => 'Pengarang',
                'type'  => 'text'
            ],
            [
                'name'  => 'publisher',
                'label' => 'Penerbit',
                'type'  => 'text'
            ],
            [
                'name'  => 'quantity',
                'label' => 'Stok',
                'type'  => 'number'
            ],
            [
                'name' => "cover",
                'label' => "Gambar Cover",
                'type' => 'image',
                'upload' => true,
                'crop' => true,
                'aspect_ratio' => 0,
                'disk' => 'public',
                'prefix' => 'uploads/images/book_cover/',
                'height' => '150px',
                'width' => '50px'
            ]
        ));
    }

    protected function setupCreateOperation()
    {
        $this->crud->setValidation(BookRequest::class);

        $this->crud->addFields(array(
            [
                'name'  => 'title',
                'label' => 'Judul',
                'type'  => 'text'
            ],
            [
                'name'  => 'author',
                'label' => 'Penulis',
                'type'  => 'text'
            ],
            [
                'name'  => 'editor',
                'label' => 'Pengarang',
                'type'  => 'text'
            ],
            [
                'name'  => 'publisher',
                'label' => 'Penerbit',
                'type'  => 'text'
            ],
            [
                'name'  => 'published_on',
                'label' => 'Tahun Terbit',
                'type'  => 'text'
            ],
            [
                'name'  => 'language',
                'label' => 'Bahasa',
                'type'  => 'text'
            ],
            [
                'name'  => 'edition',
                'label' => 'Edisi',
                'type'  => 'text'
            ],
            [
                'name'  => 'pages',
                'label' => 'Jumlah Halaman',
                'type'  => 'number'
            ],
            [
                'name'  => 'quantity',
                'label' => 'Stok',
                'type'  => 'number'
            ],
            [
                'name'  => 'published_on',
                'label' => 'Tahun Terbit',
                'type'  => 'year'
            ],
            [
                'name'        => 'status',
                'label'       => 'Status',
                'type'        => 'radio',
                'options'     => [
                    0 => "Tersedia",
                    1 => "Tidak Tersedia"
                ],
                'inline'      => true
            ],
            [
                'name' => "cover",
                'label' => "Gambar Cover",
                'type' => 'image',
                'upload' => true,
                'crop' => true,
                'aspect_ratio' => 0,
                'disk' => 'public',
                'prefix' => 'uploads/images/book_cover/'
            ]
        ));
    }

    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }

    protected function setupShowOperation()
    {
        $this->crud->set('show.setFromDb', false);

        $this->crud->addColumns(array(
            [
                'name'  => 'title',
                'label' => 'Judul',
                'type'  => 'text'
            ],
            [
                'name'  => 'author',
                'label' => 'Penulis',
                'type'  => 'text'
            ],
            [
                'name'  => 'editor',
                'label' => 'Pengarang',
                'type'  => 'text'
            ],
            [
                'name'  => 'publisher',
                'label' => 'Penerbit',
                'type'  => 'text'
            ],
            [
                'name'  => 'published_on',
                'label' => 'Tahun Terbit',
                'type'  => 'text'
            ],
            [
                'name'  => 'language',
                'label' => 'Bahasa',
                'type'  => 'text'
            ],
            [
                'name'  => 'edition',
                'label' => 'Edisi',
                'type'  => 'text'
            ],
            [
                'name'  => 'pages',
                'label' => 'Jumlah Halaman',
                'type'  => 'number'
            ],
            [
                'name'  => 'quantity',
                'label' => 'Stok',
                'type'  => 'number'
            ],
            [
                'name'  => 'published_on',
                'label' => 'Tahun Terbit',
                'type'  => 'year'
            ],
            [
                'name'        => 'status',
                'label'       => 'Status',
                'type'        => 'radio',
                'options'     => [
                    0 => "Tersedia",
                    1 => "Tidak Tersedia"
                ],
                'inline'      => true
            ],
            [
                'name' => "cover",
                'label' => "Gambar Cover",
                'type' => 'image',
                'upload' => true,
                'crop' => true,
                'aspect_ratio' => 0,
                'disk' => 'public',
                'prefix' => 'uploads/images/book_cover/',
                'height' => '600px',
                'width' => '300px'
            ]
        ));
    }
}
