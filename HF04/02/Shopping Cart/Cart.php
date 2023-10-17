<?php

class Cart
{
    /**
     * @var CartItem[]
     */
    private array $items = [];

    public function getItems(): array
    {
        return $this->items;
    }

    public function setItems(array $items): void
    {
        $this->items = $items;
    }

    // TODO Generate getters and setters of properties

    /**
     * Add Product $product into cart. If product already exists inside cart
     * it must update quantity.
     * This must create CartItem and return CartItem from method
     * Bonus: $quantity must not become more than whatever
     * is $availableQuantity of the Product
     *
     * @param Product $product
     * @param int $quantity
     * @return CartItem
     */
    public function addProduct(Product $product, int $quantity): CartItem
    {
        //TODO Implement method
        $cartItem = new CartItem($product, $quantity);
        $inArray = false;
        foreach ($this->getItems() as $item) {
            if ($item->getProduct()->getId() === $product->getId()) {
                $inArray = true;
                break;
            }
        }
        if ($inArray) {
            foreach ($this->getItems() as $item) {
                if ($item->getProduct()->getId() === $product->getId()) {
                    if ($item->getQuantity() + $quantity > $item->getProduct()->getAvailableQuantity()) {
                        $item->setQuantity($item->getProduct()->getAvailableQuantity());
                    } else {
                        $item->setQuantity($item->getQuantity() + $quantity);
                    }
                }
            }
        } else {
            $this->items[] = $cartItem;
            // TODO: not OOP elegant
        }
        return $cartItem;
    }

    /**
     * Remove product from cart
     *
     * @param Product $product
     */
    public function removeProduct(Product $product): void
    {
        //TODO Implement method
        $newArray = array_filter($this->items, function ($item) use ($product) {
            return $item->getProduct()->getId() !== $product->getId();
        });
        $this->setItems($newArray);
    }

    /**
     * This returns total number of products added in cart
     *
     * @return int
     */
    public function getTotalQuantity(): int
    {
        //TODO Implement method
        $totalQuantity = 0;
        foreach ($this->getItems() as $cartItem) {
            $totalQuantity += $cartItem->getQuantity();
        }
        return $totalQuantity;
    }

    /**
     * This returns total price of products added in cart
     *
     * @return float
     */
    public function getTotalSum(): float
    {
        //TODO Implement method
        $totalSum = 0;
        foreach ($this->getItems() as $cartItem) {
            $totalSum += $cartItem->getQuantity() * $cartItem->getProduct()->getPrice();
        }
        return $totalSum;
    }
}