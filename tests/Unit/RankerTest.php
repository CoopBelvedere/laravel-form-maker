<?php

namespace Belvedere\FormMaker\Tests\Unit;

use Belvedere\FormMaker\Models\Rankings\Ranker;
use Belvedere\FormMaker\Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RankerTest extends TestCase
{
    use RefreshDatabase;

    protected $ranker;

    public function setUp(): void
    {
        parent::setUp();

        $this->ranker = Ranker::forceCreate([
            'rankable_type' => 'test',
            'rankable_id' => 1,
            'ranks' => []
        ]);
    }

    /** @test */
    public function add_node_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->add(4);

        $this->assertEquals(4, $rank);
        $this->assertCount(4, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
    }

    /** @test */
    public function move_node_after_another_node_in_ranking_when_first_node_is_ahead_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->after(2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_after_another_node_in_ranking_when_first_node_is_behind_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(3)->after(1);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 2);
    }

    /** @test */
    public function move_node_after_another_node_in_ranking_when_nodes_are_equal_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->after(2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_after_another_node_in_ranking_after_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->after(4);

        $this->assertEquals(-1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_after_another_node_in_ranking_first_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->after(2);
    }

    /** @test */
    public function move_node_after_another_node_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->after(2);
    }

    /** @test */
    public function move_node_ahead_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(3)->ahead();

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 3);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 2);
    }

    /** @test */
    public function move_node_ahead_when_already_first_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->ahead();

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_ahead_when_second_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->ahead();

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_ahead_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->ahead();
    }

    /** @test */
    public function move_node_before_another_node_in_ranking_when_first_node_is_ahead_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->before(2);

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_before_another_node_in_ranking_when_first_node_is_behind_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(3)->before(2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 2);
    }

    /** @test */
    public function move_node_before_another_node_in_ranking_when_nodes_are_equal_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->before(2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_before_another_node_in_ranking_after_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->before(4);

        $this->assertEquals(-1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_before_another_node_in_ranking_first_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->before(2);
    }

    /** @test */
    public function move_node_before_another_node_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->before(2);
    }
}