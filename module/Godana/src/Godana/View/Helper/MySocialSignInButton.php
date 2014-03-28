<?php
namespace Godana\View\Helper;

use Zend\View\Helper\AbstractHelper;

class MySocialSignInButton extends AbstractHelper
{
    public function __invoke($provider, $redirect = false)
    {
        $redirectArg = $redirect ? '?redirect=' . $redirect : '';    
        $translate = $this->view->plugin('translate');    
        echo
            '<a class="btn btn-social btn-lg btn-' . $provider . ' col-sm-12 col-xs-12 col-md-12" href="'
            . $this->view->url('scn-social-auth-user/login/provider', array('provider' => $provider))
            . $redirectArg . '"><i class="fa fa-' . $provider . '"></i> ' . $translate("Sign up with") . ' ' . ucfirst($provider) . '</a>';
    }
}