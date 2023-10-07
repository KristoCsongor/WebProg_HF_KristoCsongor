<?php
class CartItem
{
    private Product $product;
    private int $quantity;

    // TODO Generate constructor with all properties of the class
    // TODO Generate getters and setters of properties
    /**
     * @param Product $product
     * @param int $quantity
     */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    public function getProduct(): Product
    {
        return $this->product;
    }

    public function setProduct(Product $product): void
    {
        $this->product = $product;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): void
    {
        $this->quantity = $quantity;
    }


    public function increaseQuantity(): void
    {
        //TODO $quantity must be increased by one.
        // Bonus: $quantity must not become more than whatever is Product::$availableQuantity
        if ($this->getQuantity() < $this->getproduct()->getAvailableQuantity()) {
            $this->setQuantity($this->getQuantity() + 1);
        } else {
            echo "Can't be more, than" . $this->product->getAvailableQuantity() . "!";
        }
    }

    public function decreaseQuantity(): void
    {
        //TODO $quantity must be increased by one.
        // Bonus: Quantity must not become less than 1
        if ($this->getQuantity() > 1) {
            $this->setQuantity($this->getQuantity() - 1);
        } else {
            echo "Can't be less, than 1!";
        }
    }
}