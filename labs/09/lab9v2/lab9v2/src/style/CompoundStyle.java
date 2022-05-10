package style;

import enumerator.StyleEnumeratorInterface;

import java.awt.*;

public class CompoundStyle implements StyleInterface {
    private StyleEnumeratorInterface enumerator;

    public CompoundStyle(StyleEnumeratorInterface enumerator) {
        this.enumerator = enumerator;
    }

    @Override
    public Color getColor() {
        final Color[] color = {new Color(255, 255, 255)};
        final boolean[] isFirst = {true};
        final boolean[] isDefault = {false};

        this.enumerator.execute(style -> {
            if (isFirst[0]) {
                color[0] = style.getColor();
                isFirst[0] = false;
            } else if (!color[0].equals(style.getColor())) {
                isDefault[0] = true;
            }
            return style;
        });

        if (isFirst[0] || isDefault[0]) {
            color[0] = new Color(255, 255, 255);
        }

        return color[0];
    }

    @Override
    public void setColor(Color color) {
        this.enumerator.execute(style -> {
            style.setColor(color);
            return style;
        });
    }
}
