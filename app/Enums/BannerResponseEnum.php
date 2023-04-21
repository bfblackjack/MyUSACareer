<?php

namespace App\Enums;

enum BannerResponseEnum: string
{
    case success = "success";
    case danger = "danger";
    case info = "info";
    case warning = "warning";
}
