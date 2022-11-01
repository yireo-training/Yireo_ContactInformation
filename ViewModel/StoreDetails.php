<?php declare(strict_types=1);

namespace Yireo\ContactInformation\ViewModel;

use Magento\Directory\Api\CountryInformationAcquirerInterface;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\View\Element\Block\ArgumentInterface;

class StoreDetails implements ArgumentInterface
{
    private ScopeConfigInterface $scopeConfig;
    private CountryInformationAcquirerInterface $countryInformationAcquirer;

    public function __construct(
        ScopeConfigInterface $scopeConfig,
        CountryInformationAcquirerInterface $countryInformationAcquirer
    ) {
        $this->scopeConfig = $scopeConfig;
        $this->countryInformationAcquirer = $countryInformationAcquirer;
    }

    public function getStoreName(): string
    {
        return (string)$this->scopeConfig->getValue('general/store_information/name');
    }

    public function getCountry(): string
    {
        $countryId = (string)$this->scopeConfig->getValue('general/store_information/country_id');
        $countryInfo = $this->countryInformationAcquirer->getCountryInfo($countryId);
        return $countryInfo->getFullNameLocale();
    }
}

