<?php

function lazy(callable $factory)
{
    return new LazyHttpKernel($factory);
}
