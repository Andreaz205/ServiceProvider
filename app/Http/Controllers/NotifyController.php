<?php

namespace App\Http\Controllers;

use App\Contracts\NotifyServiceContract;
use App\Http\Requests\NotifyRequest;
use App\Http\Resources\SuccessResource;

class NotifyController extends Controller
{
    public function notify(NotifyRequest $request): array
    {
        /** @var NotifyServiceContract $notifier */
        $notifier = app()->make(NotifyServiceContract::class, ['name' => $request->validated('notifierName')]);

        $notifier->notify('Некоторый текст для уведомления');

        return SuccessResource::make()->resolve();
    }
}
