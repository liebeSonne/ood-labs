package controller.transfer;

import java.util.function.Consumer;

public interface Movables {
    public void forEach(Consumer<? super Movable> action);
}
