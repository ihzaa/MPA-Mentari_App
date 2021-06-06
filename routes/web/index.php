<?php

#To Find Another Routes Files
$dir   = base_path('routes/web');

#Scan File To Dir
$files = scandir( $dir );

foreach ( $files as $file ) {
    if (!in_array($file, array( '.', '..', 'index.php' ))){
        require $dir . '/' . $file;
    }
};
