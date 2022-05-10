package enumerator;


import shape.ShapeInterface;
import style.StyleInterface;

import java.util.ArrayList;
import java.util.function.UnaryOperator;

public class StrokeStyleEnumerator implements StyleEnumeratorInterface {
    private ArrayList<ShapeInterface> shapes;

    public StrokeStyleEnumerator(ArrayList<ShapeInterface> shapes) {
        this.shapes = shapes;
    }

    @Override
    public void execute(UnaryOperator<StyleInterface> callback) {
        this.shapes.forEach(shape -> {
            callback.apply(shape.getStrokeStyle());
        });
    }
}
