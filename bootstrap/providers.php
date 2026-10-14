<?php

$providers = [
    App\Providers\AppServiceProvider::class,
];

if (filter_var(env('ADMIN_PANEL_ENABLED', true), FILTER_VALIDATE_BOOLEAN)) {
    $providers[] = App\Providers\Filament\AdminPanelProvider::class;
}

return $providers;
