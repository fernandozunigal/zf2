<?php
namespace Album\Table;

use Table\Table\Table;

class AlbumTable extends Table
{
    public function __construct() {
        $this->title = 'List of Albums';
        $this->buttonAdd = array('title' => 'New Album', 'urlAction' => 'add');
        $this->rowsTitle = 'Albums';
        $this->orderBy = 'albums_PK';
        $this->actions = array('old-edit' => array('title' => 'Edit Album',
                                               'image' => 'pencil.png',
                                               'action' => 'old-edit',
                                              ),
                               'edit' => array('title' => 'New Edit Album',
                                               'image' => 'pencil.png',
                                               'action' => 'edit',
                                              ),
                               'delete' => array('title' => 'Delete Album',
                                                 'image' => 'cross-circle.png',
                                                 'action' => 'delete',
                                                 'ajax' => true,
                                                 'modalConfirm' => array('type' => 'warning',
                                                                         'title' => 'Delete Album confirmation',
                                                                         'message' => 'Are you sure you want to delete the Album?',
                                                                        ),
                                                ),
                               );
        $this->multirowActions = array('title' => 'Action for Albums selected...',
                                       'actions' => array('edit' => array('title' => 'Edit Albums',
                                                                          'action' => 'edit',
                                                                         ),
                                                          'delete' => array('title' => 'Delete Albums',
                                                                            'action' => 'delete',
                                                                            'ajax' => true,
                                                                            'modalConfirm' => array('type' => 'warning',
                                                                                                    'title' => 'Delete Albums confirmation',
                                                                                                    'message' => 'Are you sure you want to delete these Albums?',
                                                                                                   ),
                                                                           ),
                                                         )
                                      );
    }
}