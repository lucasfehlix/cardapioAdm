<?php
    class Menu{
        public function addMenu($endereco,$menu){
            $file = "pdf/".$menu;
            if( file_exists( $file ) ) {
                unlink( $file );
                move_uploaded_file($endereco,'pdf/'.$menu);
            }else{
                move_uploaded_file($endereco,'pdf/'.$menu);
            }
            if( file_exists( $file ) ) {
                return true;
            }else{
                return false;
            }
        }
        public function deleteMenu($menu){
            $file = "pdf/".$menu;
            if( file_exists( $file ) ) {
                unlink( $file );
                return true;
            }else{
                return false;
            }
        }
    }
?>