<?php

class OrderFilter {
    /**
     * @var \App\Models\Order
     */
    private $order;

    /**
     * OrderFilter constructor.
     *
     * @param \App\Models\Order $order
     */
    public function __construct(\App\Models\Order $order)
    {
        $this->order = $order;
    }

    public function apply() {

    }
}
