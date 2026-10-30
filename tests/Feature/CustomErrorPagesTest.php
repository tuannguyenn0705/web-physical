<?php

namespace Tests\Feature;

use Tests\TestCase;

class CustomErrorPagesTest extends TestCase
{
    public function test_404_error_page_renders_with_custom_ui_and_no_backend_leak(): void
    {
        $response = $this->get('/non-existent-route-abc-xyz');

        $response->assertStatus(404);
        $response->assertSee('404');
        $response->assertSee('Page Not Found');
        $response->assertSee('Back to Homepage');
        $response->assertDontSee('NotFoundHttpException');
        $response->assertDontSee('Stack trace');
    }

    public function test_403_error_view_renders_cleanly(): void
    {
        $view = $this->view('errors.403');

        $view->assertSee('403');
        $view->assertSee('Access Denied');
        $view->assertSee('Back to Homepage');
    }

    public function test_500_error_view_masks_backend_details(): void
    {
        $view = $this->view('errors.500');

        $view->assertSee('500');
        $view->assertSee('Technical Issue Encountered');
        $view->assertDontSee('SQLSTATE');
        $view->assertDontSee('Exception');
        $view->assertDontSee('Stack trace');
    }

    public function test_419_error_view_renders_cleanly(): void
    {
        $view = $this->view('errors.419');

        $view->assertSee('419');
        $view->assertSee('Your Session Has Expired');
    }

    public function test_429_error_view_renders_cleanly(): void
    {
        $view = $this->view('errors.429');

        $view->assertSee('429');
        $view->assertSee('Too Many Requests');
    }

    public function test_503_error_view_renders_cleanly(): void
    {
        $view = $this->view('errors.503');

        $view->assertSee('503');
        $view->assertSee('Scheduled System Maintenance');
    }
}
