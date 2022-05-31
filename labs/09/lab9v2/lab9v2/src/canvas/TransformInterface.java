package canvas;

import java.awt.*;

public interface TransformInterface {
    public boolean contains(Point point);

    public void moveTo(Point point);

    public void translate(int x, int y);
}
