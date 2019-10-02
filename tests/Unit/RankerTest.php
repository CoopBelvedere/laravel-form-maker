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
    public function move_node_ahead_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->ahead();
    }

    /** @test */
    public function move_node_ahead_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->ahead();
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

    /** @test */
    public function move_node_down_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->down();

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 2);
    }

    /** @test */
    public function move_node_down_when_already_last_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(3)->down();

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_down_when_first_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->down();

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_down_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->down();
    }

    /** @test */
    public function move_node_down_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->down();
    }

    /** @test */
    public function check_if_node_in_ranking_when_node_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $inRanking = $this->ranker->inRanking(1);

        $this->assertIsBool($inRanking);
        $this->assertEquals(true, $inRanking);
    }

    /** @test */
    public function check_if_node_in_ranking_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $inRanking = $this->ranker->inRanking(4);

        $this->assertIsBool($inRanking);
        $this->assertEquals(false, $inRanking);
    }

    /** @test */
    public function move_node_last_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->last();

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 1);
    }

    /** @test */
    public function move_node_last_when_already_last_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(3)->last();

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_last_when_second_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->last();

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 2);
    }

    /** @test */
    public function move_node_last_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->last();
    }

    /** @test */
    public function move_node_last_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->last();
    }

    /** @test */
    public function get_node_position_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->rank(2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
    }

    /** @test */
    public function get_node_position_when_first_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->rank(1);

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
    }

    /** @test */
    public function get_node_position_when_last_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->rank(3);

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
    }

    /** @test */
    public function get_node_position_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->rank(4);

        $this->assertEquals(-1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
    }

    /** @test */
    public function remove_node_from_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $removed = $this->ranker->remove(2);

        $this->assertEquals(true, $removed);
        $this->assertCount(2, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 3);
    }

    /** @test */
    public function remove_node_when_first_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $removed = $this->ranker->remove(1);

        $this->assertEquals(true, $removed);
        $this->assertCount(2, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 3);
    }

    /** @test */
    public function remove_node_when_last_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $removed = $this->ranker->remove(3);

        $this->assertEquals(true, $removed);
        $this->assertCount(2, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
    }

    /** @test */
    public function remove_node_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $removed = $this->ranker->remove(4);

        $this->assertEquals(true, $removed);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function reverse_ranking_order()
    {
        $this->ranker->ranks = [1,2,3];

        $this->ranker->reverse();

        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 3);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 1);
    }

    /** @test */
    public function reverse_ranking_order_when_ranking_is_empty()
    {
        $this->ranker->ranks = [];

        $this->ranker->reverse();

        $this->assertCount(0, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
    }

    /** @test */
    public function order_nodes_by_ranking_position()
    {
        $this->ranker->ranks = [1,2,3];

        $orderedNodes = $this->ranker->sortByRank(collect([3,1,2]))->values()->all();

        $this->assertCount(3, $orderedNodes);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($orderedNodes[0], 1);
        $this->assertEquals($orderedNodes[1], 2);
        $this->assertEquals($orderedNodes[2], 3);
    }

    /** @test */
    public function order_nodes_by_ranking_position_when_one_node_is_not_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $orderedNodes = $this->ranker->sortByRank(collect([3,1,4,2]))->values()->all();

        $this->assertCount(4, $orderedNodes);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($orderedNodes[0], 4);
        $this->assertEquals($orderedNodes[1], 1);
        $this->assertEquals($orderedNodes[2], 2);
        $this->assertEquals($orderedNodes[3], 3);
    }

    /** @test */
    public function toggle_nodes_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->toggle(1, 3);

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 3);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 1);
    }

    /** @test */
    public function toggle_nodes_when_nodes_are_siblings_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->toggle(1, 2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function toggle_nodes_when_last_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->toggle(1, 4);

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function toggle_nodes_when_both_nodes_are_equal_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->toggle(1, 1);

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_to_index_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $index = $this->ranker->move(1)->toIndex(1);

        $this->assertEquals(1, $index);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_to_index_when_index_is_bigger_than_ranks_length_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $index = $this->ranker->move(1)->toIndex(3);

        $this->assertEquals(2, $index);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 1);
    }

    /** @test */
    public function move_node_to_index_when_index_is_less_than_zero()
    {
        $this->ranker->ranks = [1,2,3];

        $index = $this->ranker->move(1)->toIndex(-1);

        $this->assertEquals(0, $index);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_to_index_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->toIndex(2);
    }

    /** @test */
    public function move_node_to_rank_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->toRank(2);

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_to_rank_when_rank_is_higher_than_last_position_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->toRank(4);

        $this->assertEquals(3, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 1);
    }

    /** @test */
    public function move_node_to_rank_when_rank_is_bellow_first_position_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->toRank(0);

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_to_rank_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->toRank(2);
    }

    /** @test */
    public function move_node_up_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(2)->up();

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 2);
        $this->assertEquals($this->ranker->ranks[1], 1);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_up_when_already_first_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(1)->up();

        $this->assertEquals(1, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 2);
        $this->assertEquals($this->ranker->ranks[2], 3);
    }

    /** @test */
    public function move_node_up_when_last_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $rank = $this->ranker->move(3)->up();

        $this->assertEquals(2, $rank);
        $this->assertCount(3, $this->ranker->ranks);
        $this->assertIsArray($this->ranker->ranks);
        $this->assertEquals($this->ranker->ranks[0], 1);
        $this->assertEquals($this->ranker->ranks[1], 3);
        $this->assertEquals($this->ranker->ranks[2], 2);
    }

    /** @test */
    public function move_node_up_when_node_doesnt_exist_in_ranking()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->move(4)->up();
    }

    /** @test */
    public function move_node_up_without_using_move_method_first()
    {
        $this->ranker->ranks = [1,2,3];

        $this->expectException(\Exception::class);

        $this->ranker->up();
    }
}