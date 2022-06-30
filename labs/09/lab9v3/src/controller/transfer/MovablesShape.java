package controller.transfer;

import java.util.ArrayList;
import java.util.function.Consumer;

public class MovablesShape implements Movables{
    private ArrayList<Movable> movables;

    public MovablesShape(ArrayList<Movable> movables) {
        this.movables = movables;
    }
    @Override
    public void forEach(Consumer<? super Movable> action) {
        movables.forEach(action);
    }
}
