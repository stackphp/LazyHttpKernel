<?php

namespace Stack;

function lazy(callable $factory)
{
    return new LazyHttpKernel($factory);
}
