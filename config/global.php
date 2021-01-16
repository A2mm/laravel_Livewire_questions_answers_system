<?php
use Carbon\Carbon;

   return [
       'total_products' => 555,
       'comments' => [[
			'body'       => 'this is comment',
			'created_at' => Carbon::now()->diffForHumans(),
			'creator'    => 'Aone',
		]],
   ]
?>