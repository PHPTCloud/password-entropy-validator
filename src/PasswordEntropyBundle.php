<?php

declare(strict_types=1);

namespace PasswordEntropyBundle;

use PasswordEntropyBundle\DependencyInjection\PasswordEntropyBundleExtension;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @author tcloud.ax <tcloud.ax@gmail.com>
 * @since  v1.0.0
 */
class PasswordEntropyBundle extends Bundle
{
    /**
     * @return PasswordEntropyBundleExtension
     */
    public function getContainerExtension(): PasswordEntropyBundleExtension
    {
        return new PasswordEntropyBundleExtension();
    }
}