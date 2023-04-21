<?php

namespace App\Enums;

use App\Traits\Enum;

enum Jobs2CareersClassificationEnum : int
{
    use Enum;

    case Accounting = 10000;
    case Administrative = 20000;
    case AdvertisingAndMarketing = 30000;
    case Agriculture = 40000;
    case Automative = 50000;
    case Aviation = 60000;
    case BilingualTranslation = 70000;
    case Caregiving = 80000;
    case Construction = 100000;
    case ConsumerProducts = 110000;
    case CustomerService = 130000;
    case Defense = 140000;
    case Education = 170000;
    case Electronics = 190000;
    case Energy = 200000;
    case Engineering = 210000;
    case Entertainment = 220000;
    case ExecutiveManagement = 230000;
    case FacilityMaintenance = 240000;
    case Fashion = 250000;
    case BankingAndFinance = 260000;
    case Insurance = 270000;
    case Firefighting = 280000;
    case Government = 300000;
    case GraphicDesign = 310000;
    case Healthcare = 320000;
    case DentalCare = 330000;
    case Nursing = 340000;
    case Physician = 350000;
    case Hospitality = 360000;
    case Lodging = 370000;
    case HumanResources = 390000;
    case InformationTechnology = 400000;
    case InteriorDesign = 410000;
    case LawEnforcement = 430000;
    case Legal = 440000;
    case Manufacturing = 450000;
    case MaritimeTransportation = 460000;
    case Media = 470000;
    case Mining = 480000;
    case NonExecutiveManagement = 485000;
    case Nonprofit = 490000;
    case Pharmaceutical = 510000;
    case PrintingAndPublishing = 520000;
    case RealEstate = 530000;
    case Retail = 540000;
    case Sales = 550000;
    case ScientificResearch = 560000;
    case SocialServices = 580000;
    case Sports = 590000;
    case Telecommunications = 610000;
    case Remote = 620000;
    case Trucking = 630000;
    case VeterinaryServices = 650000;
    case Logistics = 660000;
    case Miscellaneous = 999000;
}
