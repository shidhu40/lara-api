<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Generator as Faker;
class ProgramApiTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_show()
    {
		$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjU0ZDUyYzNhMjZjOGJlMzMyZWEzODc0NDg4Y2I0MmQ0NGFhNDQ2M2NiZDA5MzEzNWYxZDg3Y2M2ZDU0Y2IzNzZkNTM3ODA0YWE5YWU5NmIiLCJpYXQiOjE2MjM5MTU5MTcuMjYzOTY5LCJuYmYiOjE2MjM5MTU5MTcuMjYzOTc2LCJleHAiOjE2NTU0NTE5MTcuMjQ3NDIyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.RQKCcAXuwpDLh9LrdpMtqLNVWfws5INoDbMOpVgKI4ah0UBG3A_VGFy9G_S7ZV1-r8_zX4mm7EGw-ET_sLQQ_lgxZ0rWMqkrflxe8nSN78g7RtQQOGYaZQv0VCIpG81xXf8noP_y5TYfW86xRQZtREe0lrixleSrDMJkw0O2CqX_e16FOyz-6TokIKanAOYXZQ-yy0iCy7wIKFmYJfvUCa4Grkt_zRML6cGy32WVMebwhzUDGYxSrnlUgPjyWHI3C-8926V8c21K_58Z8sgb6DCa7gmioDAfiorT4V9HhRSVRSExhFLgkFUBBx7_LgvFokDKTy6GBtvvrjCNP5TytWuJ9cTnSTV66bowrkUvHz2-n0u2Dsjxt8XbwBBK9nfSKClVcvT3Szx93GyqoHAh51tScNcz5YP9WGyAoz4ubvnmB-pqhmH-MiAC2NjSgNVHxG0YP6iE5xsVIWM_RWiNDNg-KM2StOChPg2QRjD8FHlAvzbTVLOXxir0UgJzw_AS_gpz7tMMgs67ugMClQTl1RtVErAuiRsDCtngr488LZMd4HNSqMwi2gdU639iETA_TiLJPb6lS6fyLeek2quQy8w-WRKvL6UpoTc6Y2qntq-v21EiPluy5nsMevqUYv50rGKoHr8w61g6eJiC0yakUzQo2LGdmv-YG2yfFLzoMHQ';
		$this->withHeader('Authorization', 'Bearer ' . $token)->json('GET', 'api/programs', ['Accept' => 'application/json'])
            ->assertStatus(422)
            ->assertJson(["message" => "The given data was invalid."]);
    }
	public function testCreateProgram()
	{
		
		
		$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiMjU0ZDUyYzNhMjZjOGJlMzMyZWEzODc0NDg4Y2I0MmQ0NGFhNDQ2M2NiZDA5MzEzNWYxZDg3Y2M2ZDU0Y2IzNzZkNTM3ODA0YWE5YWU5NmIiLCJpYXQiOjE2MjM5MTU5MTcuMjYzOTY5LCJuYmYiOjE2MjM5MTU5MTcuMjYzOTc2LCJleHAiOjE2NTU0NTE5MTcuMjQ3NDIyLCJzdWIiOiIzIiwic2NvcGVzIjpbXX0.RQKCcAXuwpDLh9LrdpMtqLNVWfws5INoDbMOpVgKI4ah0UBG3A_VGFy9G_S7ZV1-r8_zX4mm7EGw-ET_sLQQ_lgxZ0rWMqkrflxe8nSN78g7RtQQOGYaZQv0VCIpG81xXf8noP_y5TYfW86xRQZtREe0lrixleSrDMJkw0O2CqX_e16FOyz-6TokIKanAOYXZQ-yy0iCy7wIKFmYJfvUCa4Grkt_zRML6cGy32WVMebwhzUDGYxSrnlUgPjyWHI3C-8926V8c21K_58Z8sgb6DCa7gmioDAfiorT4V9HhRSVRSExhFLgkFUBBx7_LgvFokDKTy6GBtvvrjCNP5TytWuJ9cTnSTV66bowrkUvHz2-n0u2Dsjxt8XbwBBK9nfSKClVcvT3Szx93GyqoHAh51tScNcz5YP9WGyAoz4ubvnmB-pqhmH-MiAC2NjSgNVHxG0YP6iE5xsVIWM_RWiNDNg-KM2StOChPg2QRjD8FHlAvzbTVLOXxir0UgJzw_AS_gpz7tMMgs67ugMClQTl1RtVErAuiRsDCtngr488LZMd4HNSqMwi2gdU639iETA_TiLJPb6lS6fyLeek2quQy8w-WRKvL6UpoTc6Y2qntq-v21EiPluy5nsMevqUYv50rGKoHr8w61g6eJiC0yakUzQo2LGdmv-YG2yfFLzoMHQ';
		$data = [
			'program_title' =>  $this->faker->unique()->company,
			'program_age_rating' => 9,
			'program_description' => $this->faker->name,
			'program_type' => $this->faker->city
		];

		$response = $this->withHeader('Authorization', 'Bearer ' . $token)->json('POST', '/api/programs',$data);
		$response->assertStatus(401);
		$response->assertJson(['message' => "Unauthenticated."]);
	}
}
