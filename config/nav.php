<?php
return
    [
       [ 'icon'=> 'nav-icon fas fa-tachometer-alt',
        'route'=> 'dashboard.dashboard',
        'title'=>'Dashboard',
        'active'=> 'dashboard',

    ],
       [
        'icon'=> 'far fa-circle nav-icon',
        'route'=> 'dashboard.categories.index',
        'title'=>'Categories',
        'badge'=>'new',
        'active'=> 'categories.*',
        'ability'=>'categories.index'
    ],
       [ 'icon'=> 'far fa-circle nav-icon',
        'route'=> 'dashboard.products.index',
        'title'=>'Products',
        'active'=>'products.*',
        'ability'=>'products.index'
    ],
       [ 'icon'=> 'far fa-circle nav-icon',
        'route'=> 'dashboard.roles.index',
        'title'=>'Roles',
        'active'=>'roles.*',
        // 'ability'=>'products.index'
    ],
    //    [ 'icon'=> 'far fa-circle nav-icon,
    //     'route'=> 'dashboard',
    //     'title'=>'Dashboard'
    // ],
    ];
