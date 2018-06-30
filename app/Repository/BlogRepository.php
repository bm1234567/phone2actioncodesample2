<?php

namespace App\Repository;

use \App\Blog;

/**
 * Class BlogRepository
 *
 * This demoing the idea of possibly using Repository pattern. Certainly not a complete implementation of it.
 *
 * Of course, extending Blog directly is just a stopping point for demo purposes.
 *
 * If we were to fully implement Repository pattern, then we might do something like:
 *  1) create a RepositoryInterface
 *  2) create a BaseRepository then implements RepositoryInterface
 *  3) make BlogRepository extend BaseRepository
 *  4) bind the abstract to the concrete in the IoC ($app) which would likely need a new RepositoryServiceProvider
 *  5) in the BlogController, replace:
 *          'use App\Repository\BlogRepository'
 *          with
 *          'use App\Interfaces\RepositoryInterface as BlogRepository'
 *          or even better...
 *          'use App\Interfaces\RepositoryInterface as BlogRepositoryInterface'
 *              (and replace 'BlogRepository' with 'BlogRepositoryInterface' throughout the controller)
 *
 * This would be SOLID practices at work :-)
 *
 * Pros:
 *      - pulls logic out of controller into a separate place for bizrules to be reused (e.g. in Console)
 *          (likely, beneficial for more complex scenarios)
 *      - keeps Model cleaner by keeping complex bizrules out of them
 *      - helps keep complex bizrules out of ServiceProviders keeping them cleaner, too
 *
 * Cons:
 *      - might be unnecessary extra work for less complex scenarios since Laravel has done such a good job
 *          implementing Model
 *
 * My Opinion:
 *      - keep it simple, build good testing that allows us to refactor with confidence
 *  should the need for Repository pattern make sense.
 *
 *
 * @package App\Repository
 */

//class BlogRepository
class BlogRepository extends Blog
{
    protected $table = 'blogs';

    public static function getBlogIndex(int $perPage=15)
    {
        return Blog::orderBy('created_at', 'desc')->paginate($perPage);
    }

    public static function createBlog(array $blog, string $userId)
    {
        return Blog::create(
            array_merge(
                $blog,
                [
                    'user_id' => $userId
                ]
            ));
    }
}