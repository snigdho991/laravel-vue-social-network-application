<?php 

namespace App\Traits;

use App\Friendship;

trait Friendable
{
	public function add_friend($user_requested_id)
	{
		if ($this->id === $user_requested_id) {
			return 0;
		}

		if ($this->is_friends_with($user_requested_id) ) {
			return "already friend."; // 0
		}

		if ($this->has_pending_friend_requests_sent_to($user_requested_id) === 1) {
			return "already sent request."; // 0
		}

		if ($this->has_pending_friend_requests_from($user_requested_id) === 1) {
			return $this->accept_friend($user_requested_id);
		}

		$friendship = Friendship::create([
			'requester' => $this->id,
			'user_requested' => $user_requested_id
		]);

		if ($friendship) {
			return 1;
		}

		return 0;
	}

	public function accept_friend($requester)
	{
		if ($this->has_pending_friend_requests_from($requester) === 0) {
			return 0;
		}

		$friendship = Friendship::where('requester', $requester)
								->where('user_requested', $this->id)
								->first();

		if ($friendship) {
			$friendship->update([
				'status' => 1
			]);

			return 1;
		}

		return 0;
	}

	public function decline_request($requester)
	{
		if ($this->has_pending_friend_requests_from($requester) === 0) {
			return 0;
		}

		$friendship = Friendship::where('requester', $requester)
								->where('user_requested', $this->id)
								->first();

		if ($friendship) {
			$friendship->delete();
		}
	}

	public function friends()
	{
		$friends1 = array();
		$f1 = Friendship::where('requester', $this->id)
						->where('status', 1)
						->get();
		foreach ($f1 as $friendship) {
			array_push($friends1, \App\User::find($friendship->user_requested));
		}

		$friends2 = array();
		$f2 = Friendship::where('user_requested', $this->id)
						->where('status', 1)
						->get();
		foreach ($f2 as $friendship) {
			array_push($friends2, \App\User::find($friendship->requester));
		}

		return array_merge($friends1, $friends2);
	}

	public function friends_id()
	{
		return collect($this->friends())->pluck('id')->toArray();
	}

	public function is_friends_with($user_id)
	{
		if(in_array($user_id, $this->friends_id()))
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	public function pending_friend_requests()
	{
		$pending = array();
		$request = Friendship::where('user_requested', $this->id)
							 ->where('status', 0)
							 ->get()->sortByDesc('created_at');
		
		foreach ($request as $r) {
			array_push($pending, \App\User::find($r->requester));
		}

		return $pending;
	}

	public function pending_friend_requests_ids()
	{
		return collect($this->pending_friend_requests())->pluck('id')->toArray();
	}

	public function user_sent_pending_friend_requests()
	{
		$pending = array();
		$request = Friendship::where('requester', $this->id)
							 ->where('status', 0)
							 ->get();

		foreach ($request as $r) {
			array_push($pending, \App\User::find($r->user_requested));
		}

		return $pending;
	}

	public function user_sent_pending_friend_requests_ids()
	{
		return collect($this->user_sent_pending_friend_requests())->pluck('id')->toArray();
	}

	public function has_pending_friend_requests_from($user_id)
	{
		if(in_array($user_id, $this->pending_friend_requests_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}

	public function has_pending_friend_requests_sent_to($user_id)
	{
		if(in_array($user_id, $this->user_sent_pending_friend_requests_ids()))
		{
			return 1;
		}
		else
		{
			return 0;
		}

	}

}

?>