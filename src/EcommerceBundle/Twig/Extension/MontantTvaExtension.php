<?php
namespace EcommerceBundle\Twig\Extension;

class MontantTvaExtension extends \Twig_Extension
{
    public function getFilters()
    {
    return array(
    new \Twig_SimpleFilter('montantTva', array($this, 'MontantTva')));
    }

    public function MontantTva($prixHT, $tva)
    {
        return round ((($prixHT / $tva) - $prixHT),2);
    }

}
