package style;

import java.awt.*;

public class Style implements StyleInterface {
    private Color color;

    public Style(Color color) {
        this.setColor(color);
    }

    @Override
    public Color getColor() {
        return this.color;
    }

    @Override
    public void setColor(Color color) {
        this.color = new Color(color.getRed(), color.getGreen(), color.getBlue(), color.getAlpha());
    }
}
