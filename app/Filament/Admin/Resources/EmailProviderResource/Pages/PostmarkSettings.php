<?php

namespace App\Filament\Admin\Resources\EmailProviderResource\Pages;

use App\Filament\Admin\Resources\EmailProviderResource;
use App\Services\ConfigService;
use Filament\Resources\Pages\Page;

class PostmarkSettings extends Page
{
    protected static string $resource = EmailProviderResource::class;

    protected static string $view = 'filament.admin.resources.email-provider-resource.pages.postmark-settings';

    public function mount(): void
    {
        static::authorizeResourceAccess();
    }

    public static function canAccess(array $parameters = []): bool
    {
        $configService = app()->make(ConfigService::class);

        return $configService->isAdminSettingsEnabled();
    }
}
