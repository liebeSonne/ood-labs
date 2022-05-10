package enumerator;


import shape.ShapeInterface;
import style.StyleInterface;

import java.util.ArrayList;
import java.util.function.UnaryOperator;

public class FillStyleEnumerator implements StyleEnumeratorInterface {
    private ArrayList<ShapeInterface> shapes;

    public FillStyleEnumerator(ArrayList<ShapeInterface> shapes) {
        this.shapes = shapes;
    }

    @Override
    public void execute(UnaryOperator<StyleInterface> callback) {
        this.shapes.forEach(shape -> {
            callback.apply(shape.getFillStyle());
        });
    }
}
