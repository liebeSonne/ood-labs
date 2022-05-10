package enumerator;

import style.StyleInterface;

import java.util.concurrent.Callable;
import java.util.function.UnaryOperator;

public interface StyleEnumeratorInterface {
    public void execute(UnaryOperator<StyleInterface> callback);
}
