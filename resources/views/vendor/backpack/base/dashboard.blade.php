@extends(backpack_view('blank'))

@php
	$bookCount = App\Models\Book::count();
	$userCount = App\User::count();
	$clientCount = App\Models\Client::count();
	$lastArchiveWeekAgoCount =  App\Models\Archive::where('created_at','>=',\Carbon\Carbon::today()->subdays(7))->count();

	$widgets['before_content'][] = [
	  'type' => 'div',
	  'class' => 'row',
	  'content' => [ // widgets 
	        [
			    'type'        	=> 'progress_white',
			    'class'       	=> 'card mb-2',
	     		'progressClass'	=> 'progress-bar bg-primary',
			    'value'       	=> $userCount,
			    'description' 	=> 'Admin.',
			    'progress'    	=> (int)$userCount/10*100,
                'hint'          => 'Jumlah admin yang sudah terdaftar.',
			],
			[
			    'type'        => 'progress_white',
			    'class'       => 'card mb-2',
			    'progressClass' => 'progress-bar bg-warning',
			    'value'       => $bookCount,
			    'description' => 'Buku.',
			    'progress'    => 100,
			    'hint'        => 'Jumlah keseluruhan buku.',
			],
			[
			    'type'        => 'progress_white',
			    'class'       => 'card border-0 mb-2',
			    'progressClass' => 'progress-bar bg-success',
			    'value'       => $clientCount,
			    'description' => 'Pengguna.',
			    'progress'    => 100, // integer
			    'hint'        => 'Jumlah pengguna.',
			],
			[
			    'type'        => 'progress_white',
			    'class'       => 'card mb-2',
			    'value'       => $lastArchiveWeekAgoCount,
			    'progressClass' => 'progress-bar '.($lastArchiveWeekAgoCount>5?'bg-primary':'bg-danger'),
			    'description' => 'Peminjaman terakhir.',
			    'progress'    => 100, // integer
			    'hint'        => 'Banyak peminjaman dalam seminggu terakhir.',
			],
	  ]
	];
    $widgets['before_content'][] = [
        'type'        => 'jumbotron',
        'wrapperClass'=> 'shadow-xs',
        'heading'     => trans('backpack::base.welcome'),
        'content'     => 'ePerpustakaan-admin merupakan website yang dapat mengelola perpustakaan dengan fitur Web API yang membantu perangkat selain menggunakan browser agar dapat terintegrasi hanya pada SATU DATABASE saja.',
        'button_link' => backpack_url('logout'),
        'button_text' => trans('backpack::base.logout'),
    ];
@endphp

@section('content')
@endsection