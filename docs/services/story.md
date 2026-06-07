# Story Service

Create and explore short-form content on Basalam with the Story Service. This service lets you manage stories, reels and
feeds: publish stories and reels, list your own stories and reels, fetch another user's reels, like, update and delete
reels, browse the discovery feed and follow a hashtag feed.

## Table of Contents

- [Story Methods](#story-methods)
- [Examples](#examples)

## Story Methods

| Method                                          | Description                          | Parameters                                                                                                          |
|-------------------------------------------------|--------------------------------------|--------------------------------------------------------------------------------------------------------------------|
| [`myStories()`](#my-stories-example)            | List the current user's stories      | `count`, `activeOnly`, `lastId`, `authorization`, `auth`                                                           |
| [`createStory()`](#create-story-example)        | Create a story                       | `request`, `authorization`, `auth`                                                                                 |
| [`discovery()`](#discovery-example)             | Get the discovery feed               | `deviceId`, `cityId`, `categoryIds`, `nextIdx`, `count`, `regenerate`, `skipImpression`, `refresh`, `authorization`, `auth` |
| [`createReel()`](#create-reel-example)          | Create a reel                        | `request`, `authorization`, `auth`                                                                                 |
| [`myReels()`](#my-reels-example)                | List the current user's reels        | `limit`, `lastIdx`, `isConfirmed`, `statusFilter`, `authorization`, `auth`                                         |
| `getUserReels()`                                | Get reels of a specific user         | `userId`, `limit`, `lastIdx`, `authorization`, `auth`                                                              |
| `deleteReel()`                                  | Delete a reel                        | `reelId`, `authorization`, `auth`                                                                                  |
| `updateReel()`                                  | Update a reel                        | `reelId`, `request`, `authorization`, `auth`                                                                       |
| [`likeReel()`](#like-reel-example)              | Like or unlike a reel                | `reelId`, `request`, `authorization`, `auth`                                                                       |
| [`hashtagFeed()`](#hashtag-feed-example)        | Get a hashtag feed                   | `hashtag`, `count`, `lastId`, `authorization`, `auth`                                                              |

## Examples

### Basic Setup

```php
use Basalam\BasalamClient;
use Basalam\Auth\PersonalToken;

$auth = new PersonalToken(token: "your_access_token");
$client = new BasalamClient(auth: $auth);
```

### My Stories Example

```php
function myStoriesExample()
{
    global $client;

    $stories = $client->story->myStories(
        count: 20,
        activeOnly: true
    );

    return $stories;
}
```

### Create Story Example

```php
use Basalam\Story\Models\CreateStoryBody;

function createStoryExample()
{
    global $client;

    $story = $client->story->createStory(
        request: new CreateStoryBody(
            photoId: 987654,
            videoId: null,
            hashtags: ["handmade", "basalam"],
            products: [101, 102],
            link: null
        )
    );

    return $story;
}
```

### Create Reel Example

```php
use Basalam\Story\Models\CreateReelBody;

function createReelExample()
{
    global $client;

    $reel = $client->story->createReel(
        request: new CreateReelBody(
            type: "reel",
            videoId: 123456,
            productIds: [101, 102],
            hashtags: ["handmade"],
            metadata: null
        )
    );

    return $reel;
}
```

### My Reels Example

```php
function myReelsExample()
{
    global $client;

    $reels = $client->story->myReels(
        limit: 10,
        isConfirmed: true,
        statusFilter: "published"
    );

    return $reels;
}
```

### Like Reel Example

```php
use Basalam\Story\Models\LikeReelBody;

function likeReelExample()
{
    global $client;

    $result = $client->story->likeReel(
        reelId: 555,
        request: new LikeReelBody(
            like: true
        )
    );

    return $result;
}
```

### Discovery Example

```php
function discoveryExample()
{
    global $client;

    $feed = $client->story->discovery(
        cityId: 1,
        categoryIds: [10, 20],
        count: 15,
        refresh: true
    );

    return $feed;
}
```

### Hashtag Feed Example

```php
function hashtagFeedExample()
{
    global $client;

    $feed = $client->story->hashtagFeed(
        hashtag: "handmade",
        count: 20
    );

    return $feed;
}
```
