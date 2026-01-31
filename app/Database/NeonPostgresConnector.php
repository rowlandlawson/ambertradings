<?php

namespace App\Database;

use Illuminate\Database\Connectors\PostgresConnector;

class NeonPostgresConnector extends PostgresConnector
{
    /**
     * Create a DSN string from a configuration.
     * Adds Neon endpoint support for older libpq without SNI.
     *
     * @param  array  $config
     * @return string
     */
    protected function getDsn(array $config)
    {
        $dsn = parent::getDsn($config);
        
        // Add Neon endpoint ID for SNI workaround
        // Format: options=project=<endpoint-id>
        if (isset($config['neon_endpoint_id']) && $config['neon_endpoint_id']) {
            $dsn .= ";options='project=" . $config['neon_endpoint_id'] . "'";
        }
        
        return $dsn;
    }
}
