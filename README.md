# Stack/LazyHttpKernel

HttpKernelInterface lazy proxy.

This is useful in combination with something like UrlMap, where sub-kernels
are only created conditionally.

## Example

The basic example, assumes that `app.php` returns an instance of
`HttpKernelInterface`:

    use Stack\LazyHttpKernel;

    $app = new LazyHttpKernel(function () {
        return require __DIR__.'/../app.php';
    });

As a shortcut, you can use the `Stack\lazy` function:

    use Stack;

    $app = Stack\lazy(function () {
        return require __DIR__.'/../app.php';
    });

When combined with the UrlMap middleware it makes a bit more sense:

    use Stack;
    use Stack\UrlMap;

    $app = ...;

    $app = new UrlMap($app, [
        '/foo' => Stack\lazy(function () {
            return require __DIR__.'/../app.php';
        })
    ]);
