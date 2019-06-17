<?php

namespace Modules\Itest\Events\Handlers;

use Maatwebsite\Sidebar\Group;
use Maatwebsite\Sidebar\Item;
use Maatwebsite\Sidebar\Menu;
use Modules\Core\Events\BuildingSidebar;
use Modules\User\Contracts\Authentication;

class RegisterItestSidebar implements \Maatwebsite\Sidebar\SidebarExtender
{
    /**
     * @var Authentication
     */
    protected $auth;

    /**
     * @param Authentication $auth
     *
     * @internal param Guard $guard
     */
    public function __construct(Authentication $auth)
    {
        $this->auth = $auth;
    }

    public function handle(BuildingSidebar $sidebar)
    {
        $sidebar->add($this->extendWith($sidebar->getMenu()));
    }

    /**
     * @param Menu $menu
     * @return Menu
     */
    public function extendWith(Menu $menu)
    {
        $menu->group(trans('core::sidebar.content'), function (Group $group) {
            $group->item(trans('itest::common.title.itests'), function (Item $item) {
                $item->icon('fa fa-question-circle');
                $item->weight(10);
                $item->authorize(
                     /* append */
                );
                $item->item(trans('itest::questions.title.questions'), function (Item $item) {
                    $item->icon('fa fa-question');
                    $item->weight(0);
                    $item->append('admin.itest.question.create');
                    $item->route('admin.itest.question.index');
                    $item->authorize(
                        $this->auth->hasAccess('itest.questions.index')
                    );
                });
            
                $item->item(trans('itest::quizzes.title.quizzes'), function (Item $item) {
                    $item->icon('fa fa-copy');
                    $item->weight(0);
                    $item->append('admin.itest.quiz.create');
                    $item->route('admin.itest.quiz.index');
                    $item->authorize(
                        $this->auth->hasAccess('itest.quizzes.index')
                    );
                });
// append






            });
        });

        return $menu;
    }
}
