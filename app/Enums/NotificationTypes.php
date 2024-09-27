<?php

namespace App\Enums;

enum NotificationTypes: string
{
    case JOB = 'job';
    case MESSAGE = 'message';
    case OTHER = 'other';
}
