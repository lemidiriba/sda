<?php

Breadcrumbs::for(
    'admin.dashboard',
    function ($trail) {
        $trail->push(__('strings.backend.dashboard.title'), route('admin.dashboard'));
    }
);

Breadcrumbs::for(
    'admin.message.index',
    function ($trail) {
        $trail->push(__('strings.backend.message.message_type'), route('admin.message.index'));
    }
);



Breadcrumbs::for(
    'admin.message.typea',
    function ($trail) {
        $trail->push(__('labels.backend.messages.type_a'), route('admin.message.typea'));
    }
);

Breadcrumbs::for(
    'admin.message.typeb',
    function ($trail) {
        $trail->push(__('labels.backend.messages.type_b'), route('admin.message.typeb'));
    }
);


Breadcrumbs::for(
    'admin.message.typec',
    function ($trail) {
        $trail->push(__('labels.backend.messages.type_c'), route('admin.message.typec'));
    }
);


Breadcrumbs::for(
    'admin.message.typed',
    function ($trail) {
        $trail->push(__('labels.backend.messages.type_d'), route('admin.message.typed'));
    }
);


Breadcrumbs::for(
    'admin.message.typeunknown',
    function ($trail) {
        $trail->push(__('labels.backend.messages.type_unknown'), route('admin.message.typeunknown'));
    }
);

Breadcrumbs::for(
    'admin.profile.index',
    function ($trail) {
        $trail->push('Title Here', route('admin.profile.index'));
    }
);

Breadcrumbs::for(
    'admin.message.tablecount',
    function ($trail) {
        $trail->push('Table Count', route('admin.message.tablecount', ['', '']));
    }
);

Breadcrumbs::for(
    'admin.message.searchtable',
    function ($trail) {
        $trail->push('Search Tabale', route('admin.message.searchtable', ''));
    }
);

Breadcrumbs::for(
    'admin.profile.phone',
    function ($trail) {
        $trail->push('Profile', route('admin.profile.phone', ''));
    }
);

Breadcrumbs::for(
    'admin.pricelist.price',
    function ($trail) {
        $trail->push('Price List', route('admin.pricelist.price'));
    }
);

Breadcrumbs::for(
    'admin.profile.phone.create',
    function ($trail) {
        $trail->push('Profile', route('admin.profile.phone.create'));
    }
);


require __DIR__ . '/auth.php';
require __DIR__ . '/log-viewer.php';