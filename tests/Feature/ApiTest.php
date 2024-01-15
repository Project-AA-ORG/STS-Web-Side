namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ApiTest extends TestCase
{
    public function testLoginRoute()
    {
        // API rotasını çağır
        $response = $this->get('/api/v1/login');

        // Durumu kontrol et
        $response->assertStatus(200);

        // JSON formatındaki veriyi kontrol et
        $response->assertJson($teachers->toArray());
    }
}
