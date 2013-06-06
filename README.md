# Stack/LazyHttpKernel

HttpKernelInterface lazy proxy.

This is useful in combination with something like UrlMap, where sub-kernels
are only created conditionally.

## Example

The basic example, assumes that `app.php` returns an instance of
`HttpKernelInterface`:

    use Stack\LazyHttpKernel;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    $app = new LazyHttpKernel(function () {
        return require __DIR__.'/../app.php';
    });

When combined with the UrlMap middleware it makes a bit more sense:

    use Stack\UrlMap;
    use Stack\LazyHttpKernel;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\HttpFoundation\Response;

    $app = ...;

    $app = new UrlMap($app, [
        '/foo' => new LazyHttpKernel(function () {
            return require __DIR__.'/../app.php';
        })
    ]);
