<?php namespace Tests\Repositories;

use App\Models\;
use App\Repositories\Repository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var Repository
     */
    protected $Repo;

    public function setUp() : void
    {
        parent::setUp();
        $this->Repo = \App::make(Repository::class);
    }

    /**
     * @test create
     */
    public function test_create_()
    {
        $ = ::factory()->make()->toArray();

        $created = $this->Repo->create($);

        $created = $created->toArray();
        $this->assertArrayHasKey('id', $created);
        $this->assertNotNull($created['id'], 'Created  must have id specified');
        $this->assertNotNull(::find($created['id']), ' with given id must be in DB');
        $this->assertModelData($, $created);
    }

    /**
     * @test read
     */
    public function test_read_()
    {
        $ = ::factory()->create();

        $db = $this->Repo->find($->id);

        $db = $db->toArray();
        $this->assertModelData($->toArray(), $db);
    }

    /**
     * @test update
     */
    public function test_update_()
    {
        $ = ::factory()->create();
        $fake = ::factory()->make()->toArray();

        $updated = $this->Repo->update($fake, $->id);

        $this->assertModelData($fake, $updated->toArray());
        $db = $this->Repo->find($->id);
        $this->assertModelData($fake, $db->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_()
    {
        $ = ::factory()->create();

        $resp = $this->Repo->delete($->id);

        $this->assertTrue($resp);
        $this->assertNull(::find($->id), ' should not exist in DB');
    }
}
