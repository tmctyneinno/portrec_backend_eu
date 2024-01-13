<?php

namespace App\Enums;

enum JobApplicationStatus: string
{
    case IN_REVIEW = 'In Review';
    case SHORTLISTED = 'Shortlisted';
    case OFFERED = 'Offered';
    case INTERVIEWING = 'Interviewing';
    case UNSUITABLE = 'Unsuitable';
}
