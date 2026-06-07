<?php

namespace Basalam\Story;

use Basalam\Auth\BaseAuth;
use Basalam\Config\Config;
use Basalam\Http\BaseClient;
use Basalam\Story\Models\CreateReelBody;
use Basalam\Story\Models\CreateStoryBody;
use Basalam\Story\Models\LikeReelBody;
use Basalam\Story\Models\UpdateReelBody;

/**
 * Client for the Basalam Story service API.
 */
class StoryService extends BaseClient
{
    public function __construct(BaseAuth $auth, ?Config $config = null)
    {
        parent::__construct($auth, $config, 'story');
    }

    /**
     * My Stories V3.
     *
     * @param int|null $count count
     * @param bool|null $activeOnly active_only
     * @param int|null $lastId last_id
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function myStories(?int $count = null, ?bool $activeOnly = null, ?int $lastId = null, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/users/me/stories";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        $params = [];
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($activeOnly !== null) {
            $params['active_only'] = $activeOnly;
        }
        if ($lastId !== null) {
            $params['last_id'] = $lastId;
        }
        return $this->get($endpoint, $params, $headers);
    }

    /**
     * Create Story.
     *
     * @param CreateStoryBody $request Request payload
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function createStory(CreateStoryBody $request, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/stories";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        return $this->post($endpoint, $request->toArray(), [], $headers);
    }

    /**
     * Discovery.
     *
     * @param string|null $deviceId device_id
     * @param int|null $cityId city_id
     * @param array|null $categoryIds category_ids
     * @param int|null $nextIdx next_idx
     * @param int|null $count count
     * @param bool|null $regenerate regenerate
     * @param bool|null $skipImpression skip_impression
     * @param bool|null $refresh refresh
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function discovery(?string $deviceId = null, ?int $cityId = null, ?array $categoryIds = null, ?int $nextIdx = null, ?int $count = null, ?bool $regenerate = null, ?bool $skipImpression = null, ?bool $refresh = null, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/stories/discovery";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        $params = [];
        if ($deviceId !== null) {
            $params['device_id'] = $deviceId;
        }
        if ($cityId !== null) {
            $params['city_id'] = $cityId;
        }
        if ($categoryIds !== null) {
            $params['category_ids'] = $categoryIds;
        }
        if ($nextIdx !== null) {
            $params['next_idx'] = $nextIdx;
        }
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($regenerate !== null) {
            $params['regenerate'] = $regenerate;
        }
        if ($skipImpression !== null) {
            $params['skip_impression'] = $skipImpression;
        }
        if ($refresh !== null) {
            $params['refresh'] = $refresh;
        }
        return $this->get($endpoint, $params, $headers);
    }

    /**
     * Create Reel.
     *
     * @param CreateReelBody $request Request payload
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function createReel(CreateReelBody $request, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/reels";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        return $this->post($endpoint, $request->toArray(), [], $headers);
    }

    /**
     * My Reels.
     *
     * @param int|null $limit limit
     * @param int|null $lastIdx last_idx
     * @param bool|null $isConfirmed is_confirmed
     * @param string|null $statusFilter status_filter
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function myReels(?int $limit = null, ?int $lastIdx = null, ?bool $isConfirmed = null, ?string $statusFilter = null, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/users/me/reels";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($lastIdx !== null) {
            $params['last_idx'] = $lastIdx;
        }
        if ($isConfirmed !== null) {
            $params['is_confirmed'] = $isConfirmed;
        }
        if ($statusFilter !== null) {
            $params['status_filter'] = $statusFilter;
        }
        return $this->get($endpoint, $params, $headers);
    }

    /**
     * Get User Reels.
     *
     * @param int|string $userId user_id
     * @param int|null $limit limit
     * @param int|null $lastIdx last_idx
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function getUserReels(int $userId, ?int $limit = null, ?int $lastIdx = null, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/users/{$userId}/reels";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        $params = [];
        if ($limit !== null) {
            $params['limit'] = $limit;
        }
        if ($lastIdx !== null) {
            $params['last_idx'] = $lastIdx;
        }
        return $this->get($endpoint, $params, $headers);
    }

    /**
     * Delete Reel.
     *
     * @param int|string $reelId reel_id
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function deleteReel(int $reelId, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/reels/{$reelId}";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        return $this->delete($endpoint, [], [], $headers);
    }

    /**
     * Update Reel.
     *
     * @param int|string $reelId reel_id
     * @param UpdateReelBody $request Request payload
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function updateReel(int $reelId, UpdateReelBody $request, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/reels/{$reelId}";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        return $this->put($endpoint, $request->toArray(), $headers);
    }

    /**
     * Like Reel.
     *
     * @param int|string $reelId reel_id
     * @param LikeReelBody $request Request payload
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function likeReel(int $reelId, LikeReelBody $request, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/reels/{$reelId}/likes";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        return $this->post($endpoint, $request->toArray(), [], $headers);
    }

    /**
     * Hashtag Feed.
     *
     * @param string|null $hashtag hashtag
     * @param int|null $count count
     * @param int|null $lastId last_id
     * @param string|null $authorization authorization header
     * @param string|null $auth auth header
     * @return array
     */
    public function hashtagFeed(string $hashtag, ?int $count = null, ?int $lastId = null, ?string $authorization = null, ?string $auth = null): array
    {
        $endpoint = "/v1/feeds/hashtags";
        $headers = [];
        if ($authorization !== null) {
            $headers['authorization'] = $authorization;
        }
        if ($auth !== null) {
            $headers['auth'] = $auth;
        }
        $params = [];
        $params['hashtag'] = $hashtag;
        if ($count !== null) {
            $params['count'] = $count;
        }
        if ($lastId !== null) {
            $params['last_id'] = $lastId;
        }
        return $this->get($endpoint, $params, $headers);
    }

}
