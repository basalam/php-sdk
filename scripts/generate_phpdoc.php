#!/usr/bin/env php
<?php

/**
 * Script to generate PHPDoc annotations for BasalamClient
 *
 * This script scans all service classes and generates @method and @property
 * annotations for IDE autocompletion.,
 */

require_once __DIR__ . '/../vendor/autoload.php';

// These are built-in PHP classes, no need for use statements

// Service classes to scan
$services = [
    'core' => ['class' => 'Basalam\Core\CoreService', 'description' => 'Core service for vendor/product management'],
    'wallet' => ['class' => 'Basalam\Wallet\WalletService', 'description' => 'Wallet service for balance and transactions'],
    'order' => ['class' => 'Basalam\Order\OrderService', 'description' => 'Order service for baskets and payments'],
    'orderProcessing' => ['class' => 'Basalam\OrderProcessing\OrderProcessingService', 'description' => 'Order processing service'],
    'search' => ['class' => 'Basalam\Search\SearchService', 'description' => 'Search service for product search'],
    'upload' => ['class' => 'Basalam\Upload\UploadService', 'description' => 'Upload service for file uploads'],
    'chat' => ['class' => 'Basalam\Chat\ChatService', 'description' => 'Chat service for messaging'],
    'webhook' => ['class' => 'Basalam\Webhook\WebhookService', 'description' => 'Webhook service for webhook management'],
];

/**
 * Get the type hint string for a parameter or return type
 */
function getTypeHint($type): string
{
    if ($type === null) {
        return 'mixed';
    }

    if ($type instanceof ReflectionUnionType) {
        $types = [];
        foreach ($type->getTypes() as $t) {
            $types[] = getTypeName($t);
        }
        return implode('|', $types);
    }

    if ($type instanceof ReflectionNamedType) {
        return getTypeName($type);
    }

    return 'mixed';
}

/**
 * Get the type name, handling built-in types and classes
 */
function getTypeName(ReflectionNamedType $type): string
{
    $name = $type->getName();

    // Handle nullable types
    $nullable = $type->allowsNull() && $name !== 'mixed' ? '?' : '';

    // Map built-in types
    $builtInTypes = ['int', 'string', 'bool', 'float', 'array', 'object', 'callable', 'iterable', 'void', 'mixed', 'null', 'false', 'true'];
    if (in_array($name, $builtInTypes)) {
        return $nullable . $name;
    }

    // For class types, use full namespace
    return $nullable . '\\' . $name;
}

/**
 * Format a parameter for PHPDoc
 */
function formatParameter(ReflectionParameter $param): string
{
    $type = $param->getType();
    $typeHint = getTypeHint($type);

    // Handle variadic parameters
    $variadic = $param->isVariadic() ? '...' : '';

    // Handle default values
    $default = '';
    if ($param->isDefaultValueAvailable()) {
        try {
            $defaultValue = $param->getDefaultValue();
            if ($defaultValue === null) {
                $default = ' = null';
            } elseif (is_bool($defaultValue)) {
                $default = ' = ' . ($defaultValue ? 'true' : 'false');
            } elseif (is_string($defaultValue)) {
                $default = " = '" . addslashes($defaultValue) . "'";
            } elseif (is_array($defaultValue)) {
                $default = ' = []';
            } else {
                $default = ' = ' . var_export($defaultValue, true);
            }
        } catch (Exception $e) {
            // Some default values can't be retrieved
            if ($param->isOptional()) {
                $default = ' = ...';
            }
        }
    }

    return $typeHint . ' ' . $variadic . '$' . $param->getName() . $default;
}

/**
 * Generate @method annotations for a service
 */
function generateMethodAnnotations(string $serviceClass, string $serviceName): array
{
    $annotations = [];

    try {
        $reflection = new ReflectionClass($serviceClass);
        $methods = $reflection->getMethods(ReflectionMethod::IS_PUBLIC);

        // Group methods by category
        $methodGroups = [
            'vendor' => [],
            'product' => [],
            'user' => [],
            'shipping' => [],
            'category' => [],
            'wallet' => [],
            'order' => [],
            'search' => [],
            'upload' => [],
            'chat' => [],
            'webhook' => [],
            'other' => []
        ];

        foreach ($methods as $method) {
            // Skip constructor and inherited methods from BaseClient
            $methodName = $method->getName();
            if ($methodName === '__construct' ||
                $method->getDeclaringClass()->getName() !== $serviceClass) {
                continue;
            }

            // Generate parameter list
            $params = [];
            foreach ($method->getParameters() as $param) {
                $params[] = formatParameter($param);
            }
            $paramString = implode(', ', $params);

            // Get return type
            $returnType = $method->getReturnType();
            $returnTypeHint = getTypeHint($returnType);

            // Get method description from docblock if available
            $description = ucfirst(str_replace('_', ' ', preg_replace('/([A-Z])/', ' $1', $methodName)));
            $docComment = $method->getDocComment();
            if ($docComment) {
                // Extract first line of description
                if (preg_match('/\*\s+([^@\n]+)/', $docComment, $matches)) {
                    $description = trim($matches[1]);
                }
            }

            // Create the @method annotation
            $annotation = sprintf(
                ' * @method %s %s(%s) %s',
                $returnTypeHint,
                $methodName,
                $paramString,
                $description
            );

            // Categorize method
            $lowerMethod = strtolower($methodName);
            if (strpos($lowerMethod, 'vendor') !== false) {
                $methodGroups['vendor'][] = $annotation;
            } elseif (strpos($lowerMethod, 'product') !== false || strpos($lowerMethod, 'discount') !== false) {
                $methodGroups['product'][] = $annotation;
            } elseif (strpos($lowerMethod, 'user') !== false || strpos($lowerMethod, 'bank') !== false) {
                $methodGroups['user'][] = $annotation;
            } elseif (strpos($lowerMethod, 'shipping') !== false) {
                $methodGroups['shipping'][] = $annotation;
            } elseif (strpos($lowerMethod, 'categor') !== false) {
                $methodGroups['category'][] = $annotation;
            } elseif (strpos($lowerMethod, 'wallet') !== false || strpos($lowerMethod, 'balance') !== false ||
                strpos($lowerMethod, 'expense') !== false || strpos($lowerMethod, 'refund') !== false ||
                strpos($lowerMethod, 'transaction') !== false) {
                $methodGroups['wallet'][] = $annotation;
            } elseif (strpos($lowerMethod, 'order') !== false || strpos($lowerMethod, 'basket') !== false ||
                strpos($lowerMethod, 'invoice') !== false || strpos($lowerMethod, 'payment') !== false ||
                strpos($lowerMethod, 'parcel') !== false || strpos($lowerMethod, 'item') !== false) {
                $methodGroups['order'][] = $annotation;
            } elseif (strpos($lowerMethod, 'search') !== false || strpos($lowerMethod, 'suggest') !== false) {
                $methodGroups['search'][] = $annotation;
            } elseif (strpos($lowerMethod, 'upload') !== false || strpos($lowerMethod, 'file') !== false) {
                $methodGroups['upload'][] = $annotation;
            } elseif (strpos($lowerMethod, 'message') !== false || strpos($lowerMethod, 'thread') !== false ||
                strpos($lowerMethod, 'chat') !== false) {
                $methodGroups['chat'][] = $annotation;
            } elseif (strpos($lowerMethod, 'webhook') !== false) {
                $methodGroups['webhook'][] = $annotation;
            } else {
                $methodGroups['other'][] = $annotation;
            }
        }

        // Build annotations with categories
        foreach ($methodGroups as $group => $groupMethods) {
            if (!empty($groupMethods)) {
                sort($groupMethods); // Sort alphabetically within each group
                $annotations = array_merge($annotations, $groupMethods);
            }
        }

    } catch (Exception $e) {
        echo "Error processing service $serviceClass: " . $e->getMessage() . "\n";
    }

    return $annotations;
}

/**
 * Generate the complete PHPDoc block
 */
function generatePHPDoc(): string
{
    global $services;

    $doc = "/**\n";
    $doc .= " * Main client for interacting with the Basalam API.\n";
    $doc .= " *\n";
    $doc .= " * This client provides access to all Basalam services through a unified interface.\n";
    $doc .= " * It automatically configures and instantiates service-specific clients.\n";
    $doc .= " *\n";
    $doc .= " * You can access service methods in two ways:\n";
    $doc .= " * 1. Through service attributes: \$client->webhook->getWebhooks()\n";
    $doc .= " * 2. Directly from client: \$client->getWebhooks()\n";
    $doc .= " * \n";
    $doc .= " * \n";
    $doc .= " * AUTO-GENERATED: This documentation is auto-generated by scripts/generate_phpdoc.php\n";
    $doc .= " * Run 'make generate-docs' to regenerate after adding new methods.\n";
    $doc .= " * \n";

    // Add @property annotations for services
    $doc .= " * Service Properties:\n";
    foreach ($services as $name => $info) {
        $className = basename(str_replace('\\', '/', $info['class']));
        $doc .= " * @property \\{$info['class']} \${$name} {$info['description']}\n";
    }
    $doc .= " * \n";

    // Add @method annotations for each service
    $allAnnotations = [];
    foreach ($services as $name => $info) {
        $serviceAnnotations = generateMethodAnnotations($info['class'], $name);
        if (!empty($serviceAnnotations)) {
            $serviceName = basename(str_replace('\\', '/', $info['class']));
            $doc .= " * {$serviceName} Methods:\n";
            foreach ($serviceAnnotations as $annotation) {
                $doc .= $annotation . "\n";
            }
            $doc .= " * \n";
        }
    }

    $doc .= " */";

    return $doc;
}

/**
 * Update the BasalamClient.php file with new PHPDoc
 */
function updateBasalamClient(string $newDoc): void
{
    $clientFile = __DIR__ . '/../src/Basalam/BasalamClient.php';

    if (!file_exists($clientFile)) {
        throw new Exception("BasalamClient.php not found at: $clientFile");
    }

    $content = file_get_contents($clientFile);

    // Find the class declaration
    $pattern = '/\/\*\*.*?\*\/\s*class\s+BasalamClient/s';

    // Replace the old PHPDoc with the new one
    $newContent = preg_replace($pattern, $newDoc . "\nclass BasalamClient", $content, 1, $count);

    if ($count === 0) {
        throw new Exception("Could not find BasalamClient class declaration");
    }

    // Write back to file
    file_put_contents($clientFile, $newContent);

    echo "✅ Successfully updated BasalamClient.php with generated PHPDoc annotations\n";
    echo "📝 Services processed: " . count($GLOBALS['services']) . "\n";
}

// Main execution
try {
    echo "🔄 Generating PHPDoc annotations for BasalamClient...\n";

    $phpDoc = generatePHPDoc();
    updateBasalamClient($phpDoc);

    echo "✨ Done! IDE autocompletion should now work for all service methods.\n";

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage() . "\n";
    exit(1);
}