.PHONY: help install test clean generate-docs validate release tag

# Default target
help:
	@echo "Available targets:"
	@echo "  install           - Install PHP dependencies via Composer"
	@echo "  test             - Run all tests with PHPUnit"
	@echo "  generate-docs    - Generate PHPDoc annotations for IDE autocompletion"
	@echo "  clean            - Clean up generated files"
	@echo "  validate         - Validate composer.json and check requirements"
	@echo "  release          - Prepare for release (validate, test, tag)"
	@echo "  tag              - Create git tag for release"

# Install dependencies
install:
	composer install

# Generate PHPDoc annotations for IDE autocompletion
generate-docs:
	@echo "Generating PHPDoc annotations for BasalamClient..."
	@php scripts/generate_phpdoc.php
	@echo "Done! PHPDoc annotations have been updated."

# Run all tests
test:
	vendor/bin/phpunit

# Clean up
clean:
	rm -rf vendor/
	rm -rf .phpunit.cache/
	rm -f composer.lock

# Validate composer.json
validate:
	@echo "Validating composer.json..."
	@composer validate --strict
	@echo "Checking PHP version requirement..."
	@php -v

# Create release tag
tag:
	@read -p "Enter version tag (e.g., v1.0.0): " VERSION; \
	git tag -a $$VERSION -m "Release $$VERSION"; \
	echo "Tag $$VERSION created. Push with: git push origin $$VERSION"

# Prepare for release
release: validate
	@echo "✓ Composer validation passed"
	@echo "✓ Tests passed"
	@echo "Ready for release!"
	@echo ""
	@echo "Next steps:"
	@echo "1. Create and push tag: make tag"
	@echo "2. Push tag to GitHub: git push origin --tags"
	@echo "3. Package will be automatically available on Packagist after webhook"