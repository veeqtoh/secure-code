<?php

namespace Veeqtoh\SecureCode\Tests\Unit\Classes;

use Illuminate\Support\Facades\Config;
use PHPUnit\Framework\Attributes\Test;
use Veeqtoh\SecureCode\Classes\Validation;
use Veeqtoh\SecureCode\Exceptions\ValidationException;
use Veeqtoh\SecureCode\Tests\Unit\TestCase;

final class ValidationTest extends TestCase
{
    #[Test]
    public function exception_is_thrown_if_the_code_length_is_not_an_integer(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.code_length field must be an integer.');

        Config::set('secure-code.code_length', 'INVALID');

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_code_length_is_not_provided(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.code_length field is required.');

        Config::set('secure-code.code_length', '');

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_code_length_is_greater_than_19(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.code_length field must not be greater than 19');

        Config::set('secure-code.code_length', 29);

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_character_repeated_limit_is_not_provided(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.character_repeated_limit field is required.');

        Config::set('secure-code.character_repeated_limit', '');

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_character_repeated_limit_is_less_than_3(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.character_repeated_limit field must be at least 3.');

        Config::set('secure-code.character_repeated_limit', 2);

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_character_repeated_limit_is_greater_than_19(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.character_repeated_limit field must not be greater than 19.');

        Config::set('secure-code.character_repeated_limit', 29);

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_sequence_length_limit_is_not_provided(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.sequence_length_limit field is required.');

        Config::set('secure-code.sequence_length_limit', '');

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_sequence_length_limit_is_less_than_3(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.sequence_length_limit field must be at least 3.');

        Config::set('secure-code.sequence_length_limit', 2);

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_unique_characters_limit_is_not_provided(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.unique_characters_limit field is required.');

        Config::set('secure-code.unique_characters_limit', '');

        $validation = new Validation();
        $validation->validateConfig();
    }

    #[Test]
    public function exception_is_thrown_if_the_unique_characters_limit_is_less_than_3(): void
    {
        $this->expectException(ValidationException::class);
        $this->expectExceptionMessage('The secure-code.unique_characters_limit field must be at least 3.');

        Config::set('secure-code.unique_characters_limit', 2);

        $validation = new Validation();
        $validation->validateConfig();
    }

}