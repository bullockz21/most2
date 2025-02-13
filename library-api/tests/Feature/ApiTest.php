<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Librarian;
use App\Models\Book;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Тест регистрации и авторизации пользователя.
     */
    public function test_user_registration_and_login()
    {
        // Регистрация пользователя
        $registerResponse = $this->json('POST', '/api/v1/auth/register', [
            'name'                  => 'Test User',
            'email'                 => 'testuser@example.com',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $registerResponse->assertStatus(200);

        // Авторизация пользователя
        $loginResponse = $this->json('POST', '/api/v1/auth/login', [
            'email'    => 'testuser@example.com',
            'password' => 'password123',
        ]);
        $loginResponse->assertStatus(200);
        $loginResponse->assertJsonStructure(['token']);

        $token = $loginResponse->json('token');
        $this->assertNotEmpty($token);
    }

    /**
     * Тест операций "Брать книгу" и "Сдать книгу обратно" для пользователя.
     */
    public function test_borrow_and_return_book()
    {
        // Создаем пользователя и получаем JWT
        $user = User::factory()->create([
            'password' => bcrypt('password123'),
        ]);

        $loginResponse = $this->postJson('/api/v1/auth/login', [
            'email'    => $user->email,
            'password' => 'password123',
        ]);
        $token = $loginResponse->json('token');

        // Создаем книгу через фабрику (убедитесь, что фабрика для Book настроена)
        $book = Book::factory()->create([
            'total_copies'     => 5,
            'available_copies' => 5,
        ]);

        // Отправляем запрос на взятие книги: POST /api/v1/user/books/{book}/borrow
        $borrowResponse = $this->withHeader('Authorization', "Bearer $token")
            ->postJson("/api/v1/user/books/{$book->id}/borrow");
        $borrowResponse->assertStatus(200);
        $borrowResponse->assertJson(['message' => 'Книга успешно взята']);

        // Проверяем, что число доступных копий уменьшилось
        $book->refresh();
        $this->assertEquals(4, $book->available_copies);

        // Отправляем запрос на возврат книги: POST /api/v1/user/books/{book}/return
        $returnResponse = $this->withHeader('Authorization', "Bearer $token")
            ->postJson("/api/v1/user/books/{$book->id}/return");
        $returnResponse->assertStatus(200);
        $returnResponse->assertJsonPath('data.message',  'Книга успешно возвращена');

        // Проверяем, что число доступных копий восстановилось
        $book->refresh();
        $this->assertEquals(5, $book->available_copies);
    }

    /**
     * Тест CRUD-операций для книг, выполняемых библиотекарем.
     */
    public function test_crud_operations_for_books_by_librarian()
    {
        // Создаем библиотекаря и получаем JWT
        $librarian = \App\Models\Librarian::factory()->create([
            'password' => bcrypt('librarianpass'),
        ]);

        $loginResponse = $this->postJson('/api/v1/librarian/auth/login', [
            'email'    => $librarian->email,
            'password' => 'librarianpass',
        ]);
        $loginResponse->assertStatus(200);
        $token = $loginResponse->json('token');
        $this->assertNotEmpty($token, 'JWT-токен для библиотекаря не получен');

        // Создание книги: POST /api/v1/librarian/books
        $createResponse = $this->withHeader('Authorization', "Bearer $token")
            ->postJson('/api/v1/librarian/books', [
                'title'            => 'New Book',
                'author'           => 'Author Name',
                'description'      => 'Book description',
                'total_copies'     => 10,
                'available_copies' => 10,
            ]);
        $createResponse->assertStatus(201);
        $createResponse->assertJsonStructure(['data' => ['id', 'title', 'author', 'description', 'total_copies', 'available_copies']]);
        $bookId = $createResponse->json('data.id');

        // Изменение книги: PUT /api/v1/librarian/books/{book}
        $updateResponse = $this->withHeader('Authorization', "Bearer $token")
            ->putJson("/api/v1/librarian/books/{$bookId}", [
                'title' => 'Updated Book Title',
            ]);
        $updateResponse->assertStatus(200);
        $updateResponse->assertJsonPath('data.title', 'Updated Book Title');

        // Удаление книги: DELETE /api/v1/librarian/books/{book}
        $deleteResponse = $this->withHeader('Authorization', "Bearer $token")
            ->deleteJson("/api/v1/librarian/books/{$bookId}");
        $deleteResponse->assertStatus(200);
        $deleteResponse->assertJson(['message' => 'Книга успешно удалена']);
    }
}
